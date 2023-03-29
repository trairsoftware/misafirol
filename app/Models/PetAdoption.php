<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetAdoption extends Model
{
    use HasFactory;

    protected $table = 'pet_adoption';

    protected $fillable = [
        'user_id',
        'title',
        'city',
        'province',
        'detail',
        'status',
        'is_active'
    ];
}
