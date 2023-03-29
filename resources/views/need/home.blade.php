@extends('layouts.app')

@section('content')

<div class="container my-3">
    <div class="row ">
        <div class="col-10 offset-1">
            <div class="row gy-2 gap-2 d-flex justify-content-center">
                <div class="col-5 col-md-2  btn btn-secondary" style=" color: white; padding: 7.5px; font-size:13px; font-weight: 700; border-radius: 7.5px; ">
                    <a href="{{ url('/needs/foods') }}" style="text-decoration: none; color: white"><span>Gıda : {{count($food)}}</span></a>
                </div>
                <div class="col-5 col-md-2 btn btn-secondary" style=" color: white; padding: 7.5px; font-size:13px;  font-weight: 700; border-radius: 7.5px; ">
                    <a href="{{ url('/needs/clothes') }}" style="text-decoration: none; color: white"> <span> Giyim : {{count($clothes)}}</span></a>
                </div>
                <div class="col-5 col-md-2 btn btn-secondary" style=" color: white; padding: 7.5px; font-size:13px;  font-weight: 700; border-radius: 7.5px ;
                    ">
                    <a href="{{ url('/needs/baby') }}" style="text-decoration: none; color: white"> <span> Anne Bebek Ürünleri : {{count($baby)}}</span></a>
                </div>
                <div class="col-5 col-md-2 btn btn-secondary" style=" color: white; padding: 7.5px; font-size:13px;  font-weight: 700; border-radius: 7.5px;
                   ">
                    <a href="{{ url('/needs/shoe') }}" style="text-decoration: none; color: white"><span> Ayakkabı : {{count($shoe)}}</span></a>
                </div>
                <div class="col-5 col-md-2 btn btn-secondary" style=" color: white; padding: 7.5px; font-size:13px;  font-weight: 700; border-radius: 7.5px ;
                    ">
                    <a href="{{ url('/needs/other') }}" style="text-decoration: none; color: white"> <span> Diğer : {{count($other)}}</span></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4 mb-2">
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-12">
            <div class="row d-flex justify-content-center gap-1">
                @isset($institutional)
                @component('components.menu', ['class' => 'btn btn-success', 'url' => url('/home/individual'), 'title' => 'Misafir Ol İlanları', 'count' => $institutional])@endcomponent
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
            @if(\Illuminate\Support\Facades\Auth::user()->type === 'guest')
            <a type="button" class="btn btn-success text-white" href="{{url('need/add')}}">
                İlan Oluştur
            </a>
            @endif
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
                                <input id="exampleInputEmail1" name="phone_number" maxlength="10" placeholder="Telefon numaranızı giriniz..." value="{{ \Illuminate\Support\Facades\Auth::user()->phone_number }}">

                                <button type="submit" class="btn btn-secondary btn-sm">Sms Gönder</button><br>
                                <span>Telefon numaranızı başında 0 olmadan giriniz.</span><br>
                                @if(isset($errors) && $errors === 'gsmError')<span class="text-danger">Bir Hata İle Karşılaşıldı Lütfen Tekrar Deneyiniz.</span>@endif
                            </div>
                        </form>
                        @else
                        <form method="post" action="{{ url('checkOtp') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input id="exampleInputEmail1" name="otp_key" placeholder="Doğrulama Kodunu Giriniz">

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
                        İhtiyaç Havuzu İlanları
                    </div>
                    <div>

                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <style>
                        @media only screen and (min-width: 1439px) {
                            input[type='search'] {
                                width: 450px;
                                margin: auto;
                            }

                            .datatables_filter {
                                width: 750px;
                                margin-bottom: 25px;
                            }

                            .dataTables_filter>label {
                                margin: auto;
                                position: relative;
                                font-weight: bold;
                                top: 50%;
                                left: -75%;
                            }

                            .dataTables_length {
                                margin-bottom: 25px;
                            }
                        }
                    </style>
                    <table class="table display nowrap table-stripped" id="need-table" style="width: 100%">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">İhtiyaç Türü</th>
                                <th scope="col">Başlık</th>
                                <th scope="col">İl / İlçe</th>
                                <th scope="col">İlan Durumu</th>
                                <th scope="col">İlan Tarihi</th>
                                <th scope="col">İlan Saati</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script type="text/javascript">
    $(function() {
        let defaultTableColumns = [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'need_type',
                name: 'need_type'
            },
            {
                data: 'title',
                name: 'title'
            },
            {
                data: 'city',
                name: 'city'
            },
            {
                data: 'is_active',
                name: 'is_active'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'created_time_at',
                name: 'created_time_at'
            },
            {
                data: 'action',
                name: 'action'
            },
        ];

        $('#need-table').DataTable({
            ...dataTablesConfig,
            processing: true,
            serverSide: true,
            ajax: "{{ url('need/getNeeds/') }}",
            columns: [
                ...defaultTableColumns
            ]
        });

    });
</script>
@endpush
@endsection