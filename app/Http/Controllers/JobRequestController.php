<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Need;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobRequestController extends Controller
{
    public function add($id)
    {
        if (strpos(request()->headers->get('referer'), 'jobs/request/edit') > -1) {
            session()->flashInput([]);
        }

        return view('jobs_requests.create', ['id' => $id]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'job_id' => 'required',
            'request_detail' => 'required|string',
        ]);

        $attributes = $request->only([
            'job_id',
            'request_detail'
        ]);

        $need = Job::where('id', $request->job_id)->get();

        $ownerUser = User::find($need[0]->user_id);

        $user = Auth::user();
        $attributes['detail'] = $request['request_detail'];
        $attributes['user_id'] = $user->id;

        $message = 'Sayın ' . $user->name . ' '. $user->surname. ' talebiniz başarıyla oluşturulmuştur.';
        $ownerMessage = 'Sayın ' . $ownerUser->name . ' '. $ownerUser->surname. ', ilanınıza talep oluşturuldu. https://misafirol.org/jobs/request/get/'
            . $request->job_id . ' üzerinden detaylara ulaşabilirsiniz.';
        $smsController = new SmsController();
        $smsController->sendSms($user->phone_number, $message);
        $smsController->sendSms($ownerUser->phone_number, $ownerMessage);

        \App\Models\JobRequest::create($attributes);
        return redirect('/')->with('success', 'true');
    }

    public function getRequests(Request $request, $id)
    {
        $jobs = DB::table('users')
            ->join('job_requests', 'users.id', '=', 'job_requests.user_id')
            ->where('job_id', $id)
            ->select('users.name', 'users.phone_number', 'job_requests.job_id', 'job_requests.created_at', 'job_requests.detail')
            ->get();

        return view('jobs_requests.list', ['jobs' => $jobs]);
    }

    public function list(Request $request)
    {
        $requests = DB::table('job_requests');
        $isAdmin = Auth::user()->type === 'admin';
        $isOwner = Auth::user()->type === 'owner';

        if ($isAdmin || $isOwner) {
            $requests = $requests
                ->join('users', 'job_requests.user_id', '=', 'users.id')
                ->select('users.name', 'users.phone_number', 'job_requests.need_id', 'job_requests.created_at', 'job_requests.detail')
                ->get();
        } else {
            $user_id = Auth::id();

            $requests = $requests
                ->where('user_id', $user_id)
                ->get();
        }

        return view('jobs_requests.list', ['jobs' => $requests]);
    }}
