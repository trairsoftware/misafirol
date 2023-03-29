@extends('layouts.app')

@section('content')
<div class="container hello">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header">Aktif İlanlar</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <table class="table display nowrap table-stripped" id="myTable" style="width: 100%">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Şehir</th>
                                @isset(Auth::user()->type)
                                @if(Auth::user()->type === 'admin')
                                <th scope="col">İlan Sahibi (Ad-Soyad)</th>
                                <th scope="col">İlan Sahibi (Gsm)</th>
                                @endif
                                @endisset
                                <th scope="col">Kontenjan</th>
                                <th scope="col">Cinsiyet Tercihi</th>
                                <th scope="col">Detay</th>
                                <th scope="col">Ulaşım Desteği</th>
                                <th scope="col">İlan Tarihi</th>
                                <th scope="col">Durum</th>
                                <th scope="col">Operatör Yorumu </th>
                                <th scope="col">Arama Türü </th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($posts)
                            @foreach($posts as $post)
                            <tr>
                                <td scope="row">{{$post->id ?? '-'}}</td>
                                <td scope="row">{{$post->city ?? '-'}}/{{$post->province ?? '-'}}</td>
                                @isset(Auth::user()->type)
                                @if(Auth::user()->type === 'admin')
                                <th scope="col">{{$post->getUser->name ?? ''}} - {{$post->getUser->surname ?? ''}}</th>
                                <th scope="col">{{$post->getUser->phone_number ?? "-"}}</th>
                                @endif
                                @endisset
                                <td scope="row">{{$post->capacity ?? '-' }}</td>
                                <td scope="row">
                                    @switch($post->gender_preference)
                                    @case('female')
                                    Kadın
                                    @break
                                    @case('male')
                                    Erkek
                                    @break
                                    @case('no')
                                    Yok
                                    @break
                                    @default
                                    -
                                    @break
                                    @endswitch
                                </td>
                                <td scope="row">
                                    {!! $post->detail !!}
                                </td>
                                @switch($post->transport_assist)
                                @case(0)
                                <td scope="row">
                                    Yok
                                    @break
                                    @case(1)
                                <td scope="row" style="background-color: greenyellow">
                                    Var
                                    @break

                                    @default
                                    -
                                    @endswitch
                                </td>
                                <td scope="row">{{$post->created_at ?? '-'}}</td>

                                @switch($post->is_active)
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

                                <td scope="row">{{$post->operation_comment ?? '-'}}</td>
                                <td scope="row">{{$post->is_called_type ?? '-'}}</td>

                                <td scope="row">
                                    <a class="btn btn-primary" href="{{ url('post/detail/' . $post->id ) }}">
                                        Detay
                                    </a>
                                    <a class="btn btn-primary" href="{{ url('request/get/' . $post->id ) }}">
                                        Başvurular
                                    </a>

                                    <a class="btn btn-danger" href="{{ url('post/close/' . $post->id ) }}">
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