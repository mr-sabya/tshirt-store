<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'user_id',
        'feedback',
        'call_time',
    ];

    /**
     * Get the lead that owns the call history.
     */
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    /**
     * Get the user who made the call.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
