<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'city',
        'phone_number',
        'type',
        'tc_no',
        'is_verified',
        'nvi_check',
        'surname',
        'birthday',
        'tax_number',
        'tax_adminastration',
        'institutional_type',
        'is_institutional',
        'company_name',
        'district',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getPost(){
        return $this->HasMany(Post::class, 'user_id', 'id');
    }

    public function getRequest(){
        return $this->HasMany(Request::class, 'user_id', 'id');
    }
}
