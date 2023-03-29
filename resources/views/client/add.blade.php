@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            @if(isset($action) && $action === 'edit')
                                Düzenle
                            @else
                                Ekle
                            @endif
                        </div>

                    </div>
                    <div class="card-body">
                        @if(isset($action) && $action === 'edit')
                            <form method="POST" action="{{ url('client/edit/'. $client->id) }}"
                                  enctype="multipart/form-data">
                                @method('PATCH')
                                @else
                                    <form method="POST" action="{{ url('client/add') }}"
                                          enctype="multipart/form-data">
                                        @endif
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                @component('components.form.input', ['name' => 'name', 'label' => 'Şirket Adı'])@endcomponent
                                                @component('components.form.input', ['name' => 'short_name', 'label' => 'Kısa Ad'])@endcomponent
                                                @component('components.form.input', ['name' => 'contact_name', 'label' => 'Yetkili Kişi'])@endcomponent
                                                @component('components.form.input', ['name' => 'contact_phone', 'label' => 'Yetkili Numarası'])@endcomponent
                                                @component('components.form.input', ['name' => 'contact_email', 'label' => 'Yetkili E-Mail'])@endcomponent
                                                @component('components.form.input', ['name' => 'max_ticket', 'label' => 'Maksimum Açabileceği Ticket Sayısı'])@endcomponent
                                                @component('components.form.select', ['name' => 'is_active', 'label' => 'Durum', 'options' => [['label' => 'Aktif', 'value' => true], ['label' => 'Pasif', 'value' => false]]])@endcomponent
                                            </div>
                                        </div>
                                        <div class="text-right" style="margin-top: 1rem">
                                            <button class="btn btn-success">Kaydet</button>
                                        </div>
                                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
