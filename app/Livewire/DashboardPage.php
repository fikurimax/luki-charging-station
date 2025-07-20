<?php

namespace App\Livewire;

use App\Models\Session;
use App\Models\Tables;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class DashboardPage extends Component
{
    protected $listeners = [
        'refresh' => '$refresh'
    ];

    public $continuePayment = 0;
    public ?Tables $stationSession;

    public function mount()
    {
        $table = Tables::query()
            ->where('user_id', auth()->id())
            ->first();
        if ($table) {
            $this->continuePayment = 1;
            $this->stationSession = $table;
        }
    }

    #[On('selectTable')]
    public function selectStation(int $tableID, int $durationID)
    {
        $table = Tables::find($tableID);
        if (!$table) {
            $this->addError('errors', 'Meja yang dipilih tidak tersedia');
            return;
        }

        $duration = Session::find($durationID);
        if (!$duration) {
            $this->addError('errors', 'Durasi yang dipilih tidak tersedia');
            return;
        }

        $activeSession = Tables::query()
            ->where('user_id', auth()->id())
            ->first();
        if ($activeSession && !$activeSession->is_used) {
            $activeSession->update([
                'duration' => null,
                'payment_total' => null,
                'payment_token' => null,
                'payment_expiration' => null,
                'user_id' => null,
            ]);
        }

        $sessionToken = uniqid();
        $table->update([
            'duration' => $duration->duration,
            'payment_total' => $duration->price,
            'payment_token' => $sessionToken,
            'payment_expiration' => now()->addMinutes(10),
            'user_id' => auth()->id(),
        ]);

        return redirect("/qr?session={$sessionToken}");
    }

    #[Title('LukiStation')]
    public function render()
    {
        return view('livewire.dashboard-page');
    }
}
