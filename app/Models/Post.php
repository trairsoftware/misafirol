<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'title',
        'city',
        'province',
        'capacity',
        'gender_preference',
        'detail',
        'transport_assist',
        'status',
        'is_active',
        'start_date',
        'end_date',
        'is_institutional',
        'is_called_type',
        'operation_comment'

    ];

    public function getUser(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getRequest(){
        return $this->HasMany(Request::class, 'post_id', 'id');
    }
}
