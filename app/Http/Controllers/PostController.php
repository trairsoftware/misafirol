<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PostController extends Controller
{
    public function add()
    {

        if (strpos(request()->headers->get('referer'), 'post/edit') > -1) {
            session()->flashInput([]);
        }

        $user = Auth::user();
        $userType = $user->is_institutional ? 'institutional' : 'individual';

        if ($user->nvi_check == null || 0) {
            return view('home')->with('nviError', 'İlan oluşturabilmek için
            kimlik bilgilerinizi eksiksiz doldurmanız gerekmektedir. Kişi bilgilerinizi güncellemek için <a href="' .
                url('user/detail/' . $user->id) . '">tıklayınız.</a>')->with('type', $userType);
        }

        if ($user->is_verified === 0) {
            return view('home')->with('verified', 'sms')->with('type', $userType);
        } else {
            return view('post.create');
        }


    }

    public function create(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'detail' => 'required|string|max:1000',
            'city' => 'required|string|max:120',
            'province' => 'required|string|max:120',
            'capacity' => 'required|int|max:9999',
            'gender_preference' => 'required|in:no,male,female',
            'transport_assist' => 'required|boolean',
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
            'capacity',
            'gender_preference',
            'transport_assist',
            'start_date',
            'end_date',
        ]);
        $user = Auth::user();

        $message = 'Sayın ' . $user->name . ' ilanınız başarıyla kaydedilmiştir.';
        $attributes['user_id'] = $user->id;
        $attributes['is_institutional'] = $user->is_institutional;
        $smsController = new SmsController();

        $result = Post::create($attributes);
        if ($result->id) {
            $smsController->sendSms($user->phone_number, $message);
        }

        return redirect('/')->with('success', 'true');
    }

    public function detail($id)
    {

        $post = Post::find($id);

        session()->flashInput([
            'title' => $post->title,
            'city' => $post->city,
            'province' => $post->province,
            'capacity' => $post->capacity,
            'gender_preference' => $post->gender_preference,
            'detail' => $post->detail,
            'transport_assist' => $post->transport_assist,
            'status' => $post->transport_assist,
            'is_active' => $post->is_active,
            'start_date' => $post->start_date,
            'end_date' => $post->end_date,
            'is_institutional' => $post->is_institutional,
        ]);

        return view('post.detail')->with(['post' => $post, 'action' => 'detail']);
    }

    public function list(Request $request)
    {
        $isAdmin = Auth::user()->type === 'admin';

        if($isAdmin) {
            $posts = Post::all();
        } 
        else {
            $user_id = Auth::id();
            $posts = Post::where('user_id', $user_id)->where('is_active', true)->get();
        }

        return view('post.list', ['posts' => $posts]);
    }

    public function close(Request $request, $id)
    {
        $post = Post::find($id)->update(['is_active' => false]);
        return redirect('post/list')->with('success', 'true');
    }

    public function update(Request $request, $id)
    {
        $isAdmin = Auth::user()->type === 'admin' ? 1 : 0;

        if ($isAdmin) {
            $request->validate([
                'operation_comment' => 'required|string',
                'is_called_type' => 'required|string',
            ]);

            $attributes = $request->only([
                'operation_comment',
                'is_called_type',
            ]);;

            Post::find($id)->update($attributes);

            return redirect('/')->with('success', 'true');
        } else {
            return redirect('/');
        }
    }

    public function getPostsByType(Request $request, $type) {
        if ($request->ajax()) {
            $isInstitutional = $type == "institutional";
            $data = Post::where('is_active', true)
                ->where('posts.is_institutional', $isInstitutional)
                ->latest()
                ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    return '<a class="btn btn-primary" href="' . url('post/detail/' . $row['id']) . '">Detay</a>';
                })
                ->addColumn('city', function($row){
                    return $row['city'] . '/' . $row['province'];
                })
                ->addColumn('transport_assist', function($row){
                    return $row['transport_assist'] === true ?
                        'Var' :
                        'Yok';
                })
                ->addColumn('status', function($row) {
                    return $row['status'] === 'open' ?
                        '<span style="color: #198754">Aktif</span>' :
                        '<span style="color: red">Pasif</span>';
                })
                ->addColumn('availability_date', function ($row){
                    $startDate = $row['start_date'] ? date('m/d', strtotime($row['start_date'])) : 'Belirtilmedi';
                    $endDate = $row['end_date'] ? date('m/d', strtotime($row['end_date'])) : 'Belirtilmedi';
                    return $startDate . '-' . $endDate;
                })
                ->addColumn('post_date', function($row){
                    return $row['created_at']->addHours(3)->toDateTimeString();
                })
                ->addColumn('company_name', function($row) use ($isInstitutional) {
                    if ($isInstitutional) {
                        return $row->getUser->company_name;
                    }
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
    }


}
