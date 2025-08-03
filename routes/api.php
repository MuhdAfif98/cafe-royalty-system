<?php

use App\Services\LoyaltyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// CSRF cookie for SPA
Route::get('/sanctum/csrf-cookie', [CsrfCookieController::class, 'show']);

// Loyalty API routes
Route::middleware(['auth:sanctum'])->group(function () {
    // Get user points summary
    Route::get('/points/summary', function (Request $request) {
        $loyaltyService = app(LoyaltyService::class);
        return response()->json($loyaltyService->getPointsSummary($request->user()));
    });

    // Process QR code purchase
    Route::post('/purchase/qr', function (Request $request) {
        $request->validate([
            'qr_code' => 'required|string'
        ]);

        try {
            $loyaltyService = app(LoyaltyService::class);
            $transaction = $loyaltyService->processQrCodePurchase($request->qr_code);

            return response()->json([
                'success' => true,
                'message' => "Earned {$transaction->points} points!",
                'transaction' => $transaction
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    });

    // Process QR code redemption
    Route::post('/redemption/qr', function (Request $request) {
        $request->validate([
            'qr_code' => 'required|string'
        ]);

        try {
            $loyaltyService = app(LoyaltyService::class);
            $redemption = $loyaltyService->processQrCodeRedemption($request->qr_code);

            return response()->json([
                'success' => true,
                'message' => 'Redemption processed successfully!',
                'redemption' => $redemption
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    });

    // Manual purchase entry
    Route::post('/purchase/manual', function (Request $request) {
        $request->validate([
            'amount' => 'required|numeric|min:1|max:1000'
        ]);

        try {
            $loyaltyService = app(LoyaltyService::class);
            $transaction = $loyaltyService->earnPoints(
                $request->user(),
                $request->amount,
                null,
                'Manual purchase entry (pending staff approval)'
            );

            $transaction->update(['status' => 'pending']);

            return response()->json([
                'success' => true,
                'message' => 'Purchase submitted for staff approval',
                'transaction' => $transaction
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    });

    // Redeem points
    Route::post('/points/redeem', function (Request $request) {
        $request->validate([
            'points' => 'required|integer|min:10|max:1000'
        ]);

        try {
            $loyaltyService = app(LoyaltyService::class);
            $redemption = $loyaltyService->redeemPoints($request->user(), $request->points);

            return response()->json([
                'success' => true,
                'message' => "Redeemed {$request->points} points for \${$redemption->discount_amount} discount",
                'redemption' => $redemption
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    });

    // Get user transactions
    Route::get('/transactions', function (Request $request) {
        $user = $request->user();
        $transactions = $user->pointsTransactions()
            ->with('redemption')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return response()->json($transactions);
    });

    // Get user redemptions
    Route::get('/redemptions', function (Request $request) {
        $user = $request->user();
        $redemptions = $user->redemptions()
            ->with('pointsTransaction')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return response()->json($redemptions);
    });

    // Sync offline transactions
    Route::post('/sync-offline-transactions', function (Request $request) {
        $request->validate([
            'transactions' => 'required|array'
        ]);

        $loyaltyService = app(LoyaltyService::class);
        $results = [];

        foreach ($request->transactions as $transactionData) {
            try {
                $transaction = $loyaltyService->earnPoints(
                    $request->user(),
                    $transactionData['amount'],
                    $transactionData['transaction_id'] ?? null,
                    $transactionData['description'] ?? 'Offline transaction'
                );
                $results[] = ['success' => true, 'transaction' => $transaction];
            } catch (\Exception $e) {
                $results[] = ['success' => false, 'error' => $e->getMessage()];
            }
        }

        return response()->json([
            'success' => true,
            'results' => $results
        ]);
    });
});

// Staff API routes (for POS system)
Route::middleware(['auth:sanctum'])->prefix('staff')->group(function () {
    // Generate purchase QR code
    Route::post('/qr/purchase', function (Request $request) {
        $request->validate([
            'amount' => 'required|numeric|min:1|max:1000'
        ]);

        $qrCode = \App\Models\QrCode::generatePurchaseQr(
            $request->amount,
            uniqid('txn_', true)
        );

        return response()->json([
            'success' => true,
            'qr_code' => $qrCode->code,
            'expires_at' => $qrCode->expires_at
        ]);
    });

    // Process user QR code (staff scans customer's QR)
    Route::post('/qr/user', function (Request $request) {
        $request->validate([
            'qr_code' => 'required|string',
            'amount' => 'required|numeric|min:1|max:1000'
        ]);

        try {
            $qrCode = \App\Models\QrCode::where('code', $request->qr_code)->first();

            if (!$qrCode || !$qrCode->isValid() || $qrCode->type !== 'user') {
                throw new \Exception('Invalid or expired QR code');
            }

            $user = \App\Models\User::find($qrCode->data['user_id']);
            if (!$user) {
                throw new \Exception('User not found');
            }

            $loyaltyService = app(LoyaltyService::class);
            $transaction = $loyaltyService->earnPoints(
                $user,
                $request->amount,
                uniqid('staff_', true),
                'Staff-processed purchase'
            );

            $qrCode->markAsUsed();

            return response()->json([
                'success' => true,
                'message' => "Awarded {$transaction->points} points to {$user->name}",
                'transaction' => $transaction
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    });

    // Process redemption QR code
    Route::post('/qr/redemption', function (Request $request) {
        $request->validate([
            'qr_code' => 'required|string'
        ]);

        try {
            $loyaltyService = app(LoyaltyService::class);
            $redemption = $loyaltyService->processQrCodeRedemption($request->qr_code);

            return response()->json([
                'success' => true,
                'message' => "Applied \${$redemption->discount_amount} discount",
                'redemption' => $redemption
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    });
});
