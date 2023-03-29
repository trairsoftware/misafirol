<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone_number' => ['required', 'string', 'min:10'],
            'type' => ['required', 'string', 'in:owner,guest'],
            'tc_no' => ['required', 'string', 'min:10', 'max:12'],
            'city' => ['required', 'string'],
            'district' => ['required', 'string'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $tax_number = '';
        $tax_adminastration = '';
        $institution_type = '';
        $is_instution = '';
        $company_name = '';
        $district = $data['district'];

        if (isset($data['tax_number'])){
            $tax_number = $data['tax_number'];
            $tax_adminastration = $data['tax_adminastration'];
            $institution_type = $data['instution_type'];
            $is_instution = $data['is_instution'];
            $company_name = $data['company_name'];
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'city' => $data['city'],
            'tc_no' => $data['tc_no'],
            'type' => $data['type'],
            'phone_number' => str_replace(' ', '', $data['phone_number']),
            'tax_number' => $tax_number,
            'tax_adminastration' => $tax_adminastration,
            'institutional_type' => $institution_type,
            'is_institutional' => $is_instution == 'true'  ? true : false,
            'company_name' => $company_name,
            'district' =>$district

        ]);

    }
}
