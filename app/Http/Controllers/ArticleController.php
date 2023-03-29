<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Psy\Util\Str;

class ArticleController extends Controller
{
    public function login() {
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $token = Str::random(60);

        }
    }
}
