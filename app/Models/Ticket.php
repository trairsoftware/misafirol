<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    protected $fillable = [
        'title',
        'body',
        'ticket_owner',
        'company',
        'status',
        'is_active',
        'ticket_manager',
        'estimated_deadline',
        'started_date',
        'priority'
    ];
}
