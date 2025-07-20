<?php

namespace App\Livewire\Component;

use App\Models\Session;
use App\Models\Tables;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class TableSelection extends Component
{
    public ?int $selectedTable = null;
    public ?int $selectedDuration = 1;

    public function mount(?int $selectedTable = null, ?int $selectedDuration = null)
    {
        $this->selectedTable = $selectedTable;
        $this->selectedDuration = $selectedDuration;
    }

    public function selectTable(int $tableID, int $durationID)
    {
        $this->dispatch('selectTable', tableID: $tableID, durationID: $durationID);
    }

    public function endSession(int $tableID)
    {
        Tables::query()
            ->where('id', $tableID)
            ->update([
                'is_used' => false,
                'started_at' => null,
                'expired_at' => null,
                'duration' => null,
                'payment_total' => null,
                'payment_token' => null,
                'payment_expiration' => null,
                'user_id' => null,
            ]);

        $this->dispatch('$refresh');
    }

    public function render()
    {
        return view('livewire.component.table-selection', [
            'stations' => Tables::all(),
            'durations' => Session::all()
        ]);
    }
}
