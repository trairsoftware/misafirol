@extends('layouts.app')

@section('content')
    <div class="container hello">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">Başvurularım</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table display nowrap table-stripped" id="myTable" style="width: 100%">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">İlan ID</th>
                                <th scope="col">İlan İsim</th>
                                <th scope="col">İlan İrtibat Numarası</th>
                                <th scope="col">Detay</th>
                                <th scope="col">İlan Oluşturulma Tarihi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @isset($need_requets)
                                @foreach($need_requets as $need_requet)
                                    <tr>
                                        <td scope="row"><a  href="{{url('need/detail/'. $need_requet->need_id )}}">{{$need_requet->need_id }}</a></td>
                                            <td scope="row">{{\App\Models\User::find(\App\Models\Need::find($need_requet->need_id)->user_id)->name. ' '. \App\Models\User::find(\App\Models\Need::find($need_requet->need_id)->user_id)->surname}}</td>
                                            <td scope="row">{{\App\Models\User::find(\App\Models\Need::find($need_requet->need_id)->user_id)->phone_number}}</td>
                                        <td scope="row">{!! $need_requet->detail !!}</td>
                                        <td scope="row">{{$need_requet->created_at ?? '-'}}</td>
                                    </tr>
                                @endforeach
                            @endisset()
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection