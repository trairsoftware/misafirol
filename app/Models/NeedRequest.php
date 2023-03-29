<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NeedRequest extends Model
{
    use HasFactory;

    protected $table = 'need_requests';

    protected $fillable = [
        'need_id',
        'user_id',
        'detail'
    ];
}
