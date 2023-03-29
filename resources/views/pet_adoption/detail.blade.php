@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                İlan Detayı
                            </div>
                            <div>
                                <a class="btn btn-success" href="{{url('/petadoptions')}}">Listeye Geri Dön</a>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (isset($action) && $action === 'edit')
                                <form method="POST" action="{{ url('petadoption/edit/'. $need->id) }}"
                                      enctype="multipart/form-data">
                                    @method('PATCH')
                                    @else
                                        <form method="POST" action="{{ url('petadoption/add') }}"
                                              enctype="multipart/form-data">
                                            @endif
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @component('components.form.input', ['name' => 'title', 'label' => 'Başlık', 'disabled' => 'disabled'])@endcomponent
                                                    @component('components.form.input', ['name' => 'need_type', 'label' => 'İhtiyaç Türü', 'disabled' => 'disabled'])@endcomponent
                                                    @component('components.form.input', ['name' => 'city', 'label' => 'İl', 'disabled' => 'disabled'])@endcomponent
                                                    @component('components.form.input', ['name' => 'province', 'label' => 'İlçe', 'disabled' => 'disabled'])@endcomponent
                                                    @component('components.form.textarea', ['name' => 'detail', 'label' => 'Detay', 'disabled' => 'disabled', 'richText' => true])@endcomponent
                                                    @component('components.form.select', ['name' => 'status', 'label' => 'Durum', 'disabled' => 'disabled', 'options' => [['label' => 'Açık', 'value' => 'open'], ['label' => 'Kapatıldı', 'value' => 'closed']]])@endcomponent
                                                    @component('components.form.select', ['name' => 'is_active', 'label' => 'Aktiflik', 'disabled' => 'disabled', 'options' => [['label' => 'Aktif', 'value' => true], ['label' => 'Pasif', 'value' => false]]])@endcomponent
                                                </div>
                                            </div>
                                            <div class="text-right" style="margin-top: 1rem">
                                                <a class="btn btn-success" href="{{url('petadoption/request/add/' . $need->id )}}">Yardımda Bulun</a>
                                            </div>
                                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
