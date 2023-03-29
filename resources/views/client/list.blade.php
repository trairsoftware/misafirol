@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            Client Listesi
                        </div>
                        <div>
                            <a type="button" class="btn btn-success text-white" href="{{ url('client/add') }}">
                                <i class="fas fa-plus-circle pr-2" aria-hidden="true"></i>
                                Client Ekle
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Şirket İsmi</th>
                                <th scope="col">Kısa İsim</th>
                                <th scope="col">Açılan/Max Ticket</th>
                                <th scope="col">Durum</th>
                                <th scope="col">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @isset($clients)
                                @foreach($clients as $client)
                                    <tr>
                                        <td scope="row">{{$client->id}}</td>
                                        <td scope="row">{{$client->name}}</td>
                                        <td scope="row">{{$client->short_name}}</td>
                                        <td scope="row">?? / {{$client->max_ticket}}</td>
                                        <td scope="row">
                                            @if($client->is_active = 1)
                                                Aktif
                                            @else
                                                Pasif
                                            @endif
                                        </td>
                                        <td scope="row">
                                            <a class="btn btn-primary" href="{{ url('client/edit/' . $client->id) }}">
                                                <i class="fas fa-edit mr-2"></i>Detay
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
@endsection()
