<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Need extends Model
{
    use HasFactory;

    protected $table = 'needs';

    protected $fillable = [
        'user_id',
        'title',
        'city',
        'province',
        'need_type',
        'detail',
        'status',
        'is_active'
    ];
}
