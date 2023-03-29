<?php

namespace App\Http\Controllers;

use App\Models\Need;
use App\Models\PetAdoption;
use App\Models\PetAdoptionRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PetAdoptionRequestController extends Controller
{
    public function add($id)
    {
        if (strpos(request()->headers->get('referer'), 'petadoption/request/edit') > -1) {
            session()->flashInput([]);
        }

        return view('pet_adoption_request.create', ['id' => $id]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'pet_adoption_id' => 'required',
            'request_detail' => 'required|string',
        ]);

        $attributes = $request->only([
            'pet_adoption_id',
            'request_detail'
        ]);

        $need = PetAdoption::where('id', $request->pet_adoption_id)->get();

        $ownerUser = User::find($need[0]->user_id);

        $user = Auth::user();
        $attributes['detail'] = $request['request_detail'];
        $attributes['user_id'] = $user->id;

        $message = 'Sayın ' . $user->name . ' '. $user->surname. ' talebiniz başarıyla oluşturulmuştur.';
        $ownerMessage = 'Sayın ' . $ownerUser->name . ' '. $ownerUser->surname. ', ilanınıza talep oluşturuldu. https://misafirol.org/petadoption/request/get/'
            . $request->pet_adoption_id . ' üzerinden detaylara ulaşabilirsiniz.';
        $smsController = new SmsController();
        $smsController->sendSms($user->phone_number, $message);
        $smsController->sendSms($ownerUser->phone_number, $ownerMessage);

        \App\Models\PetAdoptionRequest::create($attributes);
        return redirect('/')->with('success', 'true');
    }

    public function getRequests(Request $request, $id)
    {
        $needs = DB::table('users')
            ->join('pet_adoption_requests', 'users.id', '=', 'pet_adoption_requests.user_id')
            ->where('pet_adoption_id', $id)
            ->select('users.name', 'users.phone_number', 'pet_adoption_requests.pet_adoption_id', 'pet_adoption_requests.created_at', 'pet_adoption_requests.detail')
            ->get();

        return view('pet_adoption_request.list', ['needs' => $needs]);
    }

    public function list(Request $request)
    {
        $requests = DB::table('pet_adoption_requests');
        $isAdmin = Auth::user()->type === 'admin';
        $isOwner = Auth::user()->type === 'owner';

        if ($isAdmin || $isOwner) {
            $requests = $requests
                ->join('users', 'pet_adoption_requests.user_id', '=', 'users.id')
                ->select('users.name', 'users.phone_number', 'pet_adoption_requests.need_id', 'pet_adoption_requests.created_at', 'pet_adoption_requests.detail')
                ->get();
        } else {
            $user_id = Auth::id();

            $requests = $requests
                ->where('user_id', $user_id)
                ->get();
        }

        return view('pet_adoption_request.list', ['needs' => $requests]);
    }
}
