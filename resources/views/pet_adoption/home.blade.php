@extends('layouts.app')

@section('content')

    <div class="container mt-4 mb-2">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-12">
                <div class="row d-flex justify-content-center gap-1" >
                    @isset($institutional)
                        @component('components.menu', ['class' => 'btn btn-success', 'url' => url('/home/individual'), 'title' => 'Misafir Ol İlanları', 'count' =>  $institutional])@endcomponent
                    @endisset

                    @isset($individual)
                        @component('components.menu', ['class' => 'btn btn-success', 'url' => url('/home/institutional'), 'title' => 'Kurumsal İlanlar', 'count' => $individual])@endcomponent
                    @endisset

                    @isset($pet_adoption)
                        @component('components.menu', ['class' => 'btn btn-success', 'url' => url('/petadoptions'), 'title' => 'Evcil Hayvan İlanı', 'count' => $pet_adoption])@endcomponent
                    @endisset

                    @isset($need)
                        @component('components.menu', ['class' => 'btn btn-success', 'url' => url('/needs/all'), 'title' => 'İhtiyaç Havuzu', 'count' => $need])@endcomponent
                    @endisset
                </div>
            </div>
            <div class="col-md-2">
                @isset(\Illuminate\Support\Facades\Auth::user()->type)
                    <a type="button" class="btn btn-success text-white" href="{{url('petadoption/add')}}">
                        İlan Oluştur
                    </a>
                @endisset()
            </div>
        </div>
    </div>

    <div class="container hello">
        <div class="row justify-content-center">
        <div class="col-12 col-sm-12">
            <div class="card">
                @if(isset($nviError))
                        <div class="alert alert-danger" role="alert">
                            {!! $nviError !!}
                        </div>
                @endif

                @if(isset($verified))

                <div class="alert alert-danger" role="alert">
                    İlan oluşturabilmek için sms doğrulaması yapmanız gerekmektedir!
                    <div class="row">
                        @if($verified === 'sms')
                        <form method="post" action="{{ url('send') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input  id="exampleInputEmail1" name="phone_number" maxlength="10"  placeholder="Telefon numaranızı giriniz..." value="{{ \Illuminate\Support\Facades\Auth::user()->phone_number }}">

                                <button type="submit" class="btn btn-secondary btn-sm">Sms Gönder</button><br>
                                <span>Telefon numaranızı başında 0 olmadan giriniz.</span><br>
                                @if(isset($errors) && $errors === 'gsmError')<span class="text-danger">Bir Hata İle Karşılaşıldı Lütfen Tekrar Deneyiniz.</span>@endif
                            </div>
                        </form>
                        @else
                            <form method="post" action="{{ url('checkOtp') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input  id="exampleInputEmail1" name="otp_key"  placeholder="Doğrulama Kodunu Giriniz">

                                    <button type="submit" class="btn btn-secondary btn-sm">Doğrula</button>
                                </div>
                                @if(isset($otp))<span class="text-danger">Hatalı Doğrulama Kodu Tekrar Deneyiniz</span>@endif
                            </form>
                        @endif
                    </div>
                </div>
                @endif
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        Evcil Hayvan İlanları
                    </div>
                    <div>

                    </div>

                </div>
                @if(isset($petadoptions))
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <style>
                        @media only screen and (min-width: 1439px) {
                            input[type='search']{
                                width: 450px;
                                margin: auto;
                            }
                            .datatables_filter{
                                width: 750px;
                                margin-bottom: 25px;
                            }
                            .dataTables_filter > label{
                                margin: auto;
                                position: relative;
                                font-weight: bold;
                                top: 50%;
                                left: -75%;
                            }
                            .dataTables_length{
                                margin-bottom: 25px;
                             }
                        }
                    </style>
                        <table class="table display nowrap table-stripped" id="myTable" style="width: 100%" >
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Başlık</th>
                                <th scope="col">İl / İlçe</th>
                                <th scope="col">İlan Durumu</th>
                                <th scope="col">İlan Tarihi</th>
                                <th scope="col">İlan Saati</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @isset($petadoptions)
                                @foreach($petadoptions as $petadoption)
                                    <tr>
                                        <td scope="row" style="font-weight: 700; text-align: center">{{$petadoption->id ?? '-'}}</td>
                                        <td scope="row" style="font-weight: 700; text-align: center">{{$petadoption->title ?? '-'}}</td>
                                        <td scope="row" style="font-weight: 700;text-align: left">{{$petadoption->city ?? '-'}}/{{$petadoption->province ?? '-'}}</td>

                                               @switch($petadoption->is_active)
                                                    @case(true)
                                                    <td scope="row"  style="color: #198754; font-weight: 700">
                                                        Aktif
                                                    @break
                                                    @case(false)
                                                    <td scope="row" style="color: red; font-weight: 700">
                                                        Kapalı
                                                    @break

                                                    @default
                                                    -
                                                @endswitch
                                            </td>

                                            <td scope="row" style="font-weight: 700">{{date('d/m/Y', strtotime(explode(' ', $petadoption->created_at)[0])) ?? '-'}}</td>
                                            <td scope="row" style="font-weight: 700">{{explode(' ', $petadoption->created_at)[1] ?? '-'}}</td>

                                            <td scope="row" >
                                                <a class="btn btn-primary" href="{{ url('petadoption/detail/' . $petadoption->id) }}">
                                                    Detay
                                                </a>
                                            </td>
                                    </tr>
                                @endforeach
                            @endisset()
                            </tbody>
                        </table>
                </div>
                    @endif
            </div>
        </div>
    </div>
    </div>
@endsection