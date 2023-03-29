<?php

namespace App\Http\Controllers;

use App\Models\Need;
use App\Models\PetAdoption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PetAdoptionController extends Controller
{
    public function add()
    {

        if (strpos(request()->headers->get('referer'), 'petadoption/edit') > -1) {
            session()->flashInput([]);
        }

        $user = Auth::user();

        if($user->nvi_check == null || 0 ) {
            return view('home')->with('nviError', 'İlan oluşturabilmek için
            kimlik bilgilerinizi eksiksiz doldurmanız gerekmektedir. Kişi bilgilerinizi güncellemek için <a href="' .
                url('user/detail/' . $user->id) . '">tıklayınız.</a>');
        }

        if($user->is_verified === 0)
        {
            return view('home')->with('verified', 'sms');
        } else {
            return view('pet_adoption.create');
        }


    }

    public function create(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'title' => 'required|string|max:255',
            'detail' => 'required|string',
            'city' => 'required|string|max:120',
            'province' => 'required|string|max:120',
            'status' => 'required|in:open,closed',
            'is_active' => 'required|boolean',
        ]);

        $attributes = $request->only([
            'title',
            'detail',
            'city',
            'province',
            'status',
            'is_active',
        ]);


        $message = 'Sayın ' . $user->name . ' ilanınız başarıyla kaydedilmiştir.';
        $attributes['user_id'] = $user->id;
        $attributes['is_institutional'] = $user->is_institutional;
        $smsController = new SmsController();

        $result = PetAdoption::create($attributes);
        if ($result->id) {
            $smsController->sendSms($user->phone_number, $message);
        }

        return redirect('/petadoptions')->with('success', 'true');
    }

    public function detail($id) {

        $need = PetAdoption::find($id);

        session()->flashInput([
            'title' => $need->title,
            'city' => $need->city,
            'province' => $need->province,
            'detail' => $need->detail,
            'status' => $need->transport_assist,
            'is_active' => $need->is_active,
        ]);

        return view('pet_adoption.detail')->with(['need' => $need, 'action' => 'detail']);
    }

    public function list(Request $request)
    {
        $needs = DB::table('pet_adoption');

        $isAdmin = Auth::user()->type === 'admin';
        if($isAdmin) {
            $needs = $needs->join('users', 'pet_adoption.user_id', '=', 'users.id')
                ->select('users.name', 'users.phone_number', 'users.tc_no', 'pet_adoption.id', 'pet_adoption.created_at',
                    'pet_adoption.detail','pet_adoption.is_active', 'pet_adoption.city', 'pet_adoption.province', )
                ->get();
        } else {
            $user_id = Auth::id();
            $needs = $needs->where('user_id', $user_id)->where('is_active', true)->orderBy('id', 'ASC')->get();
        }

        return view('pet_adoption.list', ['needs' => $needs]);
    }

    public function close(Request $request, $id)
    {
        $need = PetAdoption::find($id)->update(['is_active' => false]);
        return redirect('need/list')->with('success', 'true');
    }
}
