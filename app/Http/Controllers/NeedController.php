<?php

namespace App\Http\Controllers;

use App\Models\Need;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class NeedController extends Controller
{
    public function add()
    {

        if (strpos(request()->headers->get('referer'), 'need/edit') > -1) {
            session()->flashInput([]);
        }

        $user = Auth::user();
        $userType = $user->is_institutional ? 'institutional' : 'individual';

        if ($user->nvi_check == null || 0) {
            return view('home')->with('nviError', 'İlan oluşturabilmek için
            kimlik bilgilerinizi eksiksiz doldurmanız gerekmektedir. Kişi bilgilerinizi güncellemek için <a href="' .
                url('user/detail/' . $user->id) . '">tıklayınız.</a>')->with('type', $userType);
        }

        if($user->is_verified === 0)
        {
            return view('home')->with('verified', 'sms')->with('type', $userType);
        } else {
            return view('need.create');
        }


    }

    public function create(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'title' => 'required|string|max:255',
            'detail' => 'required|string',
            'need_type' => 'required|string',
            'city' => 'required|string|max:120',
            'province' => 'required|string|max:120',
            'status' => 'required|in:open,closed',
            'is_active' => 'required|boolean',
        ]);

        $attributes = $request->only([
            'title',
            'detail',
            'need_type',
            'city',
            'province',
            'status',
            'is_active',
        ]);


        $message = 'Sayın ' . $user->name . ' ilanınız başarıyla kaydedilmiştir.';
        $attributes['user_id'] = $user->id;
        $attributes['is_institutional'] = $user->is_institutional;
        $smsController = new SmsController();

        $result = Need::create($attributes);
        if ($result->id) {
            $smsController->sendSms($user->phone_number, $message);
        }

        return redirect('/needs/all')->with('success', 'true');
    }

    public function detail($id)
    {

        $need = Need::find($id);

        session()->flashInput([
            'title' => $need->title,
            'city' => $need->city,
            'need_type' => $need->need_type,
            'province' => $need->province,
            'detail' => $need->detail,
            'status' => $need->transport_assist,
            'is_active' => $need->is_active,
        ]);

        return view('need.detail')->with(['need' => $need, 'action' => 'detail']);
    }

    public function list(Request $request)
    {
        $needs = DB::table('needs');

        $isAdmin = Auth::user()->type === 'admin';
        if ($isAdmin) {
            $needs = $needs->join('users', 'needs.user_id', '=', 'users.id')
                ->select(
                    'users.name',
                    'users.phone_number',
                    'users.tc_no',
                    'needs.id',
                    'needs.created_at',
                    'needs.detail',
                    'posts.is_active',
                    'needs.city',
                    'needs.province'
                )
                ->get();
        } else {
            $user_id = Auth::id();
            $needs = $needs->where('user_id', $user_id)->where('is_active', true)->orderBy('id', 'ASC')->get();
        }

        return view('need.list', ['needs' => $needs]);
    }

    public function close(Request $request, $id)
    {
        $need = Need::find($id)->update(['is_active' => false]);
        return redirect('need/list')->with('success', 'true');
    }


    public function getNeeds(Request $request)
    {
        if ($request->ajax()) {
            $data = Need::where('is_active', true)
                ->latest()
                ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<a class="btn btn-primary" href="' . url('need/detail/' . $row['id']) . '">Detay</a>';
                })
                ->addColumn('need_type', function ($row) {
                    return $row['need_type'] ?? '-';
                })
                ->addColumn('city', function ($row) {
                    return $row['city'] . '/' . $row['province'];
                })
                ->addColumn('title', function ($row) {
                    return $row['title'] ?? '-';
                })
                ->addColumn('is_active', function ($row) {
                    return $row['is_active'] === true ?
                        '<span style="color: #198754">Aktif</span>' :
                        '<span style="color: red">Pasif</span>';
                })

                ->addColumn('created_at', function ($row) {
                    $date = $row['created_at']->addHours(3);
                    $date = $date ? date('d/m/Y', strtotime(explode(' ', $date)[0])) : '-';
                    return $date;
                })
                ->addColumn('created_time_at', function ($row) {

                    $date = $row['created_at']->addHours(3);
                    $date = $date ? explode(' ', $date)[1] : '-';
                    return $date;
                })

                ->rawColumns(['action', 'status', 'is_active'])
                ->make(true);
        }
    }
}
