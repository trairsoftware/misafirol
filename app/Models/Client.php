<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = [
        'name',
        'short_name',
        'contact_name',
        'contact_no',
        'contact_email',
        'max_ticket',
        'is_active'
    ];
 }
