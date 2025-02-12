<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'source',
        'status',
        'notes',
        'assigned_to',
        'converted_at',
        // Add the additional fields you want to store for a lead
        'name',           // Name of the lead/contact person
        'email',          // Email address
        'phone',          // Phone number
        'address',        // Address of the lead
        'company_name',   // Company name (if applicable)
        'lead_source',    // Lead source, e.g., website, social media
        'lead_score',     // Score based on lead's potential
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
