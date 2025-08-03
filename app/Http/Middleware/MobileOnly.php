<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Symfony\Component\HttpFoundation\Response;

class MobileOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $agent = new Agent();
        
        // Check if it's a mobile or tablet device
        $isMobile = $agent->isMobile();
        $isTablet = $agent->isTablet();
        $isDesktop = $agent->isDesktop();
        
        // Allow access only for mobile and tablet devices
        if ($isMobile || $isTablet) {
            return $next($request);
        }
        
        // Block desktop access and show a message
        if ($isDesktop) {
            return response()->view('mobile-only', [], 403);
        }
        
        // For unknown devices, also block access
        return response()->view('mobile-only', [], 403);
    }
}
