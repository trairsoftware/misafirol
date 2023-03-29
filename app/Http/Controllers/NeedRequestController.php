<?php

namespace App\Http\Controllers;

use App\Models\Need;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NeedRequestController extends Controller
{
    public function add($id)
    {
        if (strpos(request()->headers->get('referer'), 'need/request/edit') > -1) {
            session()->flashInput([]);
        }

        return view('need_requests.create', ['id' => $id]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'need_id' => 'required',
            'request_detail' => 'required|string',
        ]);

        $attributes = $request->only([
            'need_id',
            'request_detail'
        ]);

        $need = Need::where('id', $request->need_id)->get();

        $ownerUser = User::find($need[0]->user_id);

        $user = Auth::user();
        $attributes['detail'] = $request['request_detail'];
        $attributes['user_id'] = $user->id;

        $message = 'Sayın ' . $user->name . ' '. $user->surname. ' talebiniz başarıyla oluşturulmuştur.';
        $ownerMessage = 'Sayın ' . $ownerUser->name . ' '. $ownerUser->surname. ', ilanınıza talep oluşturuldu. https://misafirol.org/need/request/get/'
            . $request->need_id . ' üzerinden detaylara ulaşabilirsiniz.';
        $smsController = new SmsController();
        $smsController->sendSms($user->phone_number, $message);
        $smsController->sendSms($ownerUser->phone_number, $ownerMessage);

        \App\Models\NeedRequest::create($attributes);
        return redirect('/')->with('success', 'true');
    }

    public function getRequests(Request $request, $id)
    {
        $needs = DB::table('users')
            ->join('need_requests', 'users.id', '=', 'need_requests.user_id')
            ->where('need_id', $id)
            ->select('users.name', 'users.phone_number', 'need_requests.need_id', 'need_requests.created_at', 'need_requests.detail')
            ->get();

        return view('need_requests.list', ['needs' => $needs]);
    }

    public function list(Request $request)
    {
        $requests = DB::table('need_requests');
        $isAdmin = Auth::user()->type === 'admin';
        $isOwner = Auth::user()->type === 'owner';

        if ($isAdmin || $isOwner) {
            $requests = $requests
                ->join('users', 'need_requests.user_id', '=', 'users.id')
                ->select('users.name', 'users.phone_number', 'need_requests.need_id', 'need_requests.created_at', 'need_requests.detail')
                ->get();
        } else {
            $user_id = Auth::id();

            $requests = $requests
                ->where('user_id', $user_id)
                ->get();
        }

        return view('need_requests.list', ['needs' => $requests]);
    }

}
