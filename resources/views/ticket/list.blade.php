@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            Ticket Listesi
                        </div>
                        <div>
                            <!--<a class="btn btn-success" href="{{ url('ticket/add') }}">
                                <i class="fa fa-plus"></i>
                                Ticket Oluştur</a>
                            </a>-->
                        </div>

                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Ticket Sahibi</th>
                                <th scope="col">Başlık</th>
                                <th scope="col">Öncelik</th>
                                <th scope="col">Atanan Kişi</th>
                                <th scope="col">Durum</th>
                                <th scope="col">Başlama Tarihi</th>
                                <th scope="col">Bekleme Süresi</th>
                                <th scope="col">Tahmini Süre</th>
                                <th scope="col"></th>

                            </tr>
                            </thead>
                            <tbody>
                            @isset($tickets)
                                @foreach($tickets as $ticket)
                                    <tr>
                                        <td scope="row">{{$ticket->id}}</td>
                                        <td scope="row">{{$ticket->ticket_owner}}</td>
                                        <td scope="row">{{$ticket->title}}</td>
                                        <td scope="row">

                                            @switch($ticket->priority)
                                                @case(1)
                                                    Yüksek
                                                @break
                                                @case(2)
                                                    Orta
                                                @break
                                                @case(3)
                                                    Düşük
                                                @break
                                                @default
                                                    -
                                                @break
                                            @endswitch
                                        </td>
                                        <td scope="row">{{$ticket->ticket_manager ?? '-'}}</td>
                                            @switch($ticket->status)
                                                @case('pending')
                                            <td scope="row">
                                                Beklemede
                                                @break
                                                @case('closed')
                                            <td scope="row" style="background-color: greenyellow">
                                                Tamamlandı
                                                @break
                                                @case('in_progress')
                                            <td scope="row" style="background-color: yellow">
                                                İnceleniyor
                                                @break
                                                @default
                                                -
                                            @endswitch
                                        </td>
                                        <td scope="row">{{$ticket->started_date ? Carbon::parse($ticket->started_date)->format('d/m/Y') : '-'}}</td>
                                        <td scope="row">{{$ticket->estimated_deadline ? Carbon::parse($ticket->estimated_deadline)->format('d/m/Y') : '-'}}</td>
                                        <td scope="row">{{$ticket->started_date && $ticket->estimated_deadline ? Carbon::parse($ticket->started_date)->diffInDays(Carbon::parse($ticket->estimated_deadline)) . ' gün' : '-' }}</td>
                                        <td scope="row">
                                            <a class="btn btn-primary" href="{{ url('ticket/detail/' . $ticket->id) }}">
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
