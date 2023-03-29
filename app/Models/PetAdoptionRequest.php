<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetAdoptionRequest extends Model
{
    use HasFactory;

    protected $table = 'pet_adoption_requests';

    protected $fillable = [
        'pet_adoption_id',
        'user_id',
        'detail'
    ];
}
