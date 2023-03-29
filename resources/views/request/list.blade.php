@extends('layouts.app')

@section('content')
    <div class="container hello">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">Aktif Taleplerim</div>

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
                                    @if(Auth::user()->type === 'owner')
                                        <th scope="col">Talep Sahibi (Ad-Soyad)</th>
                                        <th scope="col">Talep Sahibi (Gsm)</th>
                                    @elseif(Auth::user()->type === 'admin')
                                        <th scope="col">İlan Sahibi (Ad-Soyad)</th>
                                        <th scope="col">İlan Sahibi (Gsm)</th>
                                        <th scope="col">Talep Sahibi (Ad-Soyad)</th>
                                        <th scope="col">Talep Sahibi (Gsm)</th>
                                    @endif
                                @endisset
                                <th scope="col">Detay</th>
                                <th scope="col">Oluşturulma Tarihi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @isset($posts)
                                @foreach($posts as $post)
                                    <tr>
                                        <td scope="row"><a
                                                    href="{{url('post/detail/'. $post->post_id )}}">{{$post->post_id }}</a>
                                        </td>
                                        @isset(Auth::user()->type)
                                            @if(Auth::user()->type === 'owner')
                                                <td scope="row">{{$post->getUser->name ?? ''}}  {{$post->getUser->surname ?? ''}}</td>
                                                <td scope="row">{{$post->getUser->phone_number ?? "-"}}</td>
                                            @elseif(Auth::user()->type === 'admin')
                                                <td scope="row">{{$post->getPost->getUser->name ?? ''}} {{$post->getUser->surname ?? ''}}</td>
                                                <td scope="row">{{$post->getPost->getUser->phone_number ?? "-"}}</td>
                                                <td scope="row">{{$post->getUser->name ?? ''}} {{$post->getUser->surname ?? ''}}</td>
                                                <td scope="row">{{$post->getUser->phone_number ?? "-"}}</td>
                                            @endif
                                        @endisset
                                        <td scope="row">{!! $post->detail !!}</td>
                                        <td scope="row">{{$post->created_at ?? '-'}}</td>
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