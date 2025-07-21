<?php

namespace App\Console\Commands;

use App\Models\Tables;
use Illuminate\Console\Command;

class ValidateTableSession extends Command
{
    protected $signature = 'app:validate-table-session';
    protected $description = 'Validate table session';

    public function handle()
    {
        $sessions = Tables::query()
            ->where('expired_at', '<', now())
            ->get();
        foreach ($sessions as $session) {
            $session->resetTable();

            $this->info("{$session->name} session expired");
        }

        $this->info("{$sessions->count()} are expired");
    }
}
