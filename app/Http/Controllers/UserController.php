<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use SoapClient;

class UserController extends Controller
{
    public function list(Request $request) {
        $isAdmin = Auth::user()->type === 'admin';
        if ($isAdmin) {
            $users = User::all();
            return view('user.list', ['users' => $users]);
        } else {
            return redirect('/');
        }
    }

    public function detail($id) {
        $isAdmin = Auth::user()->type === 'admin' ? 1 : 0;
        $haveAccess = Auth::id() == $id ? 1 : 0;

        if ($isAdmin || $haveAccess){
            $user = User::find($id);

            session()->flashInput([
                'name' => $user->name,
                'surname' => $user->surname,
                'email' => $user->email,
                'phone_number' => $user->phone_number,
                'city' => $user->city,
                'tc_no' => $user->tc_no,
                'birthday' => $user->birthday
            ]);

            return view('user.detail')->with(['user' => $user, 'action' => 'detail']);
        } else {
            return redirect('/');
        }

    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:120',
            'surname' => 'required|string|max:120',
            'tc_no' => 'required',
            'city' => 'required|string',
            'email' => 'required|string',
            'birthday' => 'required'
        ]);

        $attributes = $request->only([
            'name',
            'surname',
            'tc_no',
            'city',
            'email',
            'birthday'
        ]);

        $user = User::find($id);

        if ($user->nvi_check === null || 0) {
            $result = $this->nviCheck($request->tc_no, $request->name, $request->surname, $request->birthday);
            echo $result;
            if (!$result) {
                return Redirect::back()->withErrors(['msg' => 'Kimlik bilgileri hatalı!']);
            }
        }

        $attributes['nvi_check'] = 1;
        User::find($id)->update($attributes);
        return redirect('/')->with('success', 'true');
    }

    public function nviCheck($tc, $name, $surname, $birthday) {


        $client = new SoapClient("https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL");
        try {
            $result = $client->TCKimlikNoDogrula([
                'TCKimlikNo' => $tc,
                'Ad' => $name,
                'Soyad' => $surname,
                'DogumYili' => $birthday
            ]);
            if ($result->TCKimlikNoDogrulaResult) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->faultstring;
        }
    }
}
