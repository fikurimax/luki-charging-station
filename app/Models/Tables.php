<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tables extends Model
{
    protected $table = 'stations';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function resetTable()
    {
        $this->update([
            'is_used' => false,
            'started_at' => null,
            'expired_at' => null,
            'duration' => null,
            'payment_total' => null,
            'payment_token' => null,
            'payment_expiration' => null,
            'user_id' => null,
        ]);
    }

    public function getCasts()
    {
        return [
            // 'payment_expiration' => Carbon::class
        ];
    }
}
