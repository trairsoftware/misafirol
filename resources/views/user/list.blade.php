@extends('layouts.app')

@section('content')
<div class="container hello">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header">Kayıtlı Kullanıcılar</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <table class="table display nowrap table-stripped" id="myTable" style="width: 100%" >
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">İsim</th>
                                <th scope="col">E-Mail</th>
                                <th scope="col">Şehir</th>
                                <th scope="col">TC No</th>
                                <th scope="col">Telefon Numarası</th>
                                <th scope="col">Type</th>
                                <th scope="col">Onaylı</th>
                            </tr>
                            </thead>
                            <tbody>
                            @isset($users)
                                @foreach($users as $user)
                                    <tr>
                                    <td scope="row">{{$user->id}}</td>
                                    <td scope="row">{{$user->name}}</td>
                                    <td scope="row">{{$user->email}}</td>
                                    <td scope="row">{{$user->city}}</td>
                                    <td scope="row">{{$user->tc_no}}</td>
                                    <td scope="row">{{$user->phone_number}}</td>
                                    <td scope="row">
                                        @switch($user->type)
                                            @case('owner')
                                                Ev Sahibi
                                            @break
                                            @case('guest')
                                                Misafir
                                            @break
                                        @endswitch
                                    </td>
                                    <td scope="row">
                                        @switch($user->is_verified)
                                            @case(0)
                                                Hayır
                                            @break
                                            @case(1)
                                                Evet
                                            @break
                                        @endswitch
                                    </td>

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