<?php

namespace App\Console\Commands;

use App\Models\Tables;
use Illuminate\Console\Command;

class ValidateTablePaymentSession extends Command
{
    protected $signature = 'app:validate-table-payment-session';
    protected $description = 'Validate payment session';

    public function handle()
    {
        $sessions = Tables::query()
            ->where('payment_expiration', '<', now())
            ->get();
        foreach ($sessions as $session) {
            $session->resetTable();

            $this->info("{$session->name} payment session expired");
        }

        $this->info("{$sessions->count()} sessions are expired");
    }
}
