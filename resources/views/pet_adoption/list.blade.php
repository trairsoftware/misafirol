@extends('layouts.app')

@section('content')
<div class="container hello">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                Aktif İlanlarım
                    </div>
                    <div>
                        @isset(\Illuminate\Support\Facades\Auth::user()->type)
                                <a type="button" class="btn btn-danger text-white" href="{{url('petadoption/add')}}">
                                    İlan Oluştur
                                </a>
                        @endisset()
                    </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <table class="table display nowrap table-stripped" id="myTable" style="width: 100%" >
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">Şehir</th>
                                @isset(Auth::user()->type)
                                    @if(Auth::user()->type === 'admin')
                                        <th scope="col">İsim</th>
                                        <th scope="col">İrtibat Numarası</th>
                                    @endif
                                @endisset
                                <th scope="col">Detay</th>
                                <th scope="col">İlan Tarihi</th>
                                <th scope="col">Durum</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @isset($needs)
                                @foreach($needs as $need)
                                    <tr>
                                    <td scope="row">{{$need->city ?? '-'}}/{{$need->province ?? '-'}}</td>

                                        @isset(Auth::user()->type)
                                            @if(Auth::user()->type === 'admin')
                                            <th scope="col">{{$need->name}}</th>
                                            <th scope="col">{{$need->phone_number}}</th>
                                            @endif
                                        @endisset

                                    <td scope="row">
                                        {!! $need->detail !!}
                                    </td>
                                            <td scope="row">{{$need->created_at ?? '-'}}</td>

                                        @switch($need->is_active)
                                                @case(0)
                                            <td scope="row">
                                                Pasif
                                                @break
                                                @case(1)
                                            <td scope="row">
                                                Aktif
                                                @break

                                                @default
                                                -
                                            @endswitch
                                            </td>
                                        <td scope="row">
                                            <a class="btn btn-primary" href="{{ url('petadoption/request/get/' . $need->id ) }}">
                                                Başvurular
                                            </a>

                                            <a class="btn btn-danger" href="{{ url('petadoption/close/' . $need->id ) }}">
                                                İlanı Kapat
                                            </a>
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