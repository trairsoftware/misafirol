<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobRequest;
use App\Models\Need;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    public function add()
    {

        if (strpos(request()->headers->get('referer'), 'jobs/edit') > -1) {
            session()->flashInput([]);
        }

        $user = Auth::user();

        if ($user->nvi_check == null || 0) {
            return view('home')->with('nviError', 'İlan oluşturabilmek için
            kimlik bilgilerinizi eksiksiz doldurmanız gerekmektedir. Kişi bilgilerinizi güncellemek için <a href="' .
                url('user/detail/' . $user->id) . '">tıklayınız.</a>');
        }

        if ($user->is_verified === 0) {
            return view('home')->with('verified', 'sms');
        } else {
            return view('jobs.create');
        }


    }

    public function create(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'age' => 'required|string',
            'education_status' => 'required|string|max:255',
            'family_members' => 'required|string',
            'afad_registration' => 'required|string',
            'earthquake_site' => 'required|string',
            'previous_occupation' => 'required|string',
            'Jobs_can_work' => 'required|string',
            'searched_province' => 'required|string',
            'status' => 'required|in:open,closed',
            'is_active' => 'required|boolean'
        ]);

        $attributes = $request->only([
            'age',
            'education_status',
            'family_members',
            'afad_registration',
            'earthquake_site',
            'previous_occupation',
            'Jobs_can_work',
            'searched_province',
            'status',
            'is_active',
        ]);


        $message = 'Sayın ' . $user->name . ' ilanınız başarıyla kaydedilmiştir.';
        $attributes['user_id'] = $user->id;
        $smsController = new SmsController();

        $result = Job::create($attributes);
        if ($result->id) {
            $smsController->sendSms($user->phone_number, $message);
        }

        return redirect('/jobs')->with('success', 'true');
    }

    public function detail($id)
    {

        $job = Job::find($id);
        $user = User::find($job->user_id);

        session()->flashInput([
            'name' => $user->name,
            'phone_number' => $user->phone_number,
            'email' => $user->email,
            'age' => $job->age,
            'education_status' => $job->education_status,
            'family_members' => $job->family_members,
            'afad_registration' => $job->afad_registration,
            'earthquake_site' => $job->earthquake_site,
            'previous_occupation' => $job->previous_occupation,
            'Jobs_can_work' => $job->Jobs_can_work,
            'searched_province' => $job->searched_province,
            'status' => $job->status,
            'is_active' => $job->is_active,
        ]);

        $request = JobRequest::where('job_id', $id)->get();
        if (isset($request[0]['user_id'])){
            $is_request = ($request[0]['user_id'] == Auth::user()->id) ? true : false;
        } else {
            $is_request = false;
        }
        return view('jobs.detail')->with(['job' => $job, 'user' => $job,'is_request'=> $is_request, 'action' => 'detail']);
    }

    public function list(Request $request)
    {
        $jobs = DB::table('jobs');

        $isAdmin = Auth::user()->type === 'admin';
        if ($isAdmin) {
            $jobs = $jobs->join('users', 'jobs.user_id', '=', 'users.id')
                ->select('users.name', 'users.phone_number', 'users.email', 'jobs.id', 'jobs.created_at',
                    'jobs.age', 'jobs.education_status', 'jobs.family_members', 'jobs.afad_registration', 'jobs.earthquake_site',
                    'jobs.previous_occupation', 'jobs.Jobs_can_work', 'jobs.searched_province', 'jobs.is_active', 'jobs.province',
                )
                ->get();
        } else {
            $user_id = Auth::id();
            $jobs = $jobs->where('user_id', $user_id)->where('is_active', true)->orderBy('id', 'ASC')->get();
        }

        return view('jobs.list', ['jobs' => $jobs]);
    }

    public function close(Request $request, $id)
    {
        $jobs = Job::find($id)->update(['is_active' => false]);
        return redirect('')->with('success', 'true');
    }
}
