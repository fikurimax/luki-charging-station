<?php

namespace App\Livewire;

use App\Models\Tables;
use Livewire\Attributes\Title;
use Livewire\Component;

class QrPage extends Component
{
    public Tables $station;
    public function mount()
    {
        if (!request('session')) return redirect('/dashboard');

        $this->station = Tables::query()
            ->where('payment_token', request('session'))
            ->first();
        if (!$this->station) {
            return redirect('/dashboard');
        }
    }

    public function simulatePayment()
    {
        $this->station->update([
            'is_used' => true,
            'started_at' => now(),
            'expired_at' => now()->addSeconds($this->station->duration)
        ]);

        return redirect('/dashboard');
    }

    public function simulateExpire()
    {
        $this->station->update([
            'duration' => null,
            'payment_total' => null,
            'payment_token' => null,
            'payment_expiration' => null,
            'user_id' => null,
        ]);

        return redirect('/dashboard');
    }

    #[Title("Lanjutkan Pembayaran | LukiStation")]
    public function render()
    {
        return view('livewire.qr-page');
    }
}
