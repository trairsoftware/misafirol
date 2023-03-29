<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobRequest extends Model
{
    use HasFactory;

    protected $table = 'job_requests';

    protected $fillable = [
        'job_id',
        'user_id',
        'detail'
    ];}
