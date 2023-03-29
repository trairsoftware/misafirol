<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $table = 'requests';

    protected $fillable = [
        'post_id',
        'user_id',
        'detail'
    ];

    public function getUser(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getPost(){
        return $this->belongsTo(Post::class, 'post_id');
    }
}
