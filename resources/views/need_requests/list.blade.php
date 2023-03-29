@extends('layouts.app')

@section('content')
    <div class="container hello">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">Başvurular</div>

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
                                @isset(Auth::user()->type)
                                    @if(Auth::user()->type === 'owner' || Auth::user()->type === 'admin')
                                        <th scope="col">İsim</th>
                                        <th scope="col">İrtibat Numarası</th>
                                    @endif
                                @endisset
                                <th scope="col">Detay</th>
                                <th scope="col">Oluşturulma Tarihi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @isset($needs)
                                @foreach($needs as $need)
                                    <tr>
                                        <td scope="row"><a
                                                    href="{{url('need/detail/'. $need->need_id )}}">{{$need->need_id }}</a>
                                        </td>
                                        @isset(Auth::user()->type)

                                            @if(Auth::user()->type === 'owner' || Auth::user()->type === 'admin')
                                                <td scope="row">{{$need->name}}</td>
                                                <td scope="row">{{$need->phone_number}}</td>
                                            @endif
                                        @endisset
                                        <td scope="row">{!! $need->detail !!}</td>
                                        <td scope="row">{{$need->created_at ?? '-'}}</td>
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