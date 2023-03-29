<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'jobs';

    protected $fillable = [
        'user_id',
        'age',
        'education_status',
        'family_members',
        'afad_registration',
        'earthquake_site',
        'previous_occupation',
        'Jobs_can_work',
        'searched_province',
        'status',
        'is_active'
    ];
}
