<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Request as RequestTable; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class RequestController extends Controller
{
    public function add($id)
    {
        if (strpos(request()->headers->get('referer'), 'request/edit') > -1) {
            session()->flashInput([]);
        }

        return view('request.create', ['id' => $id]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'post_id' => 'required',
            'request_detail' => 'required|string',
        ]);

        $attributes = $request->only([
            'post_id',
            'request_detail'
        ]);

        $post = Post::where('id', $request->post_id)->get();

        $ownerUser = User::find($post[0]->user_id);

        $user = Auth::user();
        $attributes['detail'] = $request['request_detail'];
        $attributes['user_id'] = $user->id;

        $message = 'Sayın ' . $user->name . ' '. $user->surname. ' talebiniz başarıyla oluşturulmuştur.';
        $ownerMessage = 'Sayın ' . $ownerUser->name . ' '. $ownerUser->surname.  ', ' . $post[0]->id . ' numaralı ilanınıza talep oluşturuldu. https://misafirol.org/post/list üzerinden detaylara ulaşabilirsiniz.' ;
        $smsController = new SmsController();
        $smsController->sendSms($user->phone_number, $message);
        $smsController->sendSms($ownerUser->phone_number, $ownerMessage);

        \App\Models\Request::create($attributes);
        return redirect('/')->with('success', 'true');
    }

    public function getRequests($id)
    {
        $haveAcess = false;

        if (Auth::user()->type !== 'admin'){
            $post = Post::where('id', $id)->get();

            if (!count($post) > 0) {
                return abort(404);
            }

            $ownerUser = $post[0]->user_id;
            $haveAcess = $ownerUser === Auth::id();
        } else {
            $haveAcess = true;
        }

        if ($haveAcess) {
            $requests = \App\Models\Request::where('post_id', $id)->get();

            return view('request.list', ['posts' => $requests]);
        } else {
            return abort(404);
        }



    }

    public function list(Request $request)
    {        
        $isAdmin = Auth::user()->type === 'admin';

        if ($isAdmin) {
            $requests = RequestTable::all();
        } 
        else {
            $user_id = Auth::id();
            $requests = RequestTable::where('user_id', $user_id)->get();
        }

        return view('request.list', ['posts' => $requests]);
    }
}
