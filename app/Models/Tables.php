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

    public function getCasts()
    {
        return [
            // 'payment_expiration' => Carbon::class
        ];
    }
}
