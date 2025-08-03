<?php

namespace App\Livewire;

use Livewire\Component;

class QrScanner extends Component
{
    public $scanning = false;
    public $error = '';

    public function startScanner()
    {
        $this->scanning = true;
        $this->error = '';
        $this->dispatch('start-scanner');
    }

    public function stopScanner()
    {
        $this->scanning = false;
        $this->dispatch('stop-scanner');
    }

    public function handleQrCodeScanned($qrCodeData)
    {
        $this->dispatch('qr-code-scanned', $qrCodeData);
        $this->stopScanner();
    }

    public function handleScannerError($error)
    {
        $this->error = $error;
        $this->scanning = false;
    }

    public function render()
    {
        return view('livewire.qr-scanner');
    }
}
