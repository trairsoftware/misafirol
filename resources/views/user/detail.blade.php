@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                Kullanıcı Detay
                            </div>
                            <div>
                                <a class="btn btn-success" href="{{url('/')}}">Anasayfaya Dön</a>
                            </div>
                        </div>

                        @if($errors->any())
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first() }}
                            </div>

                        @endif
                        <div class="card-body">
                                <form method="POST" action="{{ url('user/edit/'. $user->id) }}"
                                      enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @component('components.form.input', ['name' => 'name', 'label' => 'Ad'])@endcomponent
                                                    @component('components.form.input', ['name' => 'surname', 'label' => 'Soyad'])@endcomponent
                                                    @component('components.form.input', ['name' => 'tc_no', 'label' => 'T.C. Kimlik Numarası'])@endcomponent
                                                    @component('components.form.input', ['name' => 'city', 'label' => 'İkamet Adresi'])@endcomponent
                                                    @component('components.form.input', ['name' => 'email', 'label' => 'E-Mail'])@endcomponent
                                                    @component('components.form.input', ['name' => 'phone_number', 'label' => 'Telefon Numarası', 'disabled' => 'disabled'])@endcomponent
                                                    @component('components.form.input', ['name' => 'birthday', 'label' => 'Doğum Yılı', 'maxlength' => 4])@endcomponent
                                                </div>
                                            </div>
                                            <div class="text-right" style="margin-top: 1rem">
                                                <button id="sendBtn" class="btn btn-success">Kaydet</button>
                                            </div>
                                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
