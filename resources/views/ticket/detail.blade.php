@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                Ticket Detay
                            </div>
                        </div>
                        <div class="card-body">
                            @if (isset($action) && $action === 'edit')
                                <form method="POST" action="{{ url('ticket/edit/'. $ticket->id) }}"
                                      enctype="multipart/form-data">
                                    @method('PATCH')
                                    @else
                                        <form method="POST" action="{{ url('ticket/add') }}"
                                              enctype="multipart/form-data">
                                            @endif
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @component('components.form.input', ['name' => 'company', 'label' => 'Şirket'])@endcomponent
                                                    @component('components.form.input', ['name' => 'ticket_owner', 'label' => 'Ticket Sahibi'])@endcomponent
                                                    @component('components.form.input', ['name' => 'title', 'label' => 'Başlık'])@endcomponent
                                                    @component('components.form.select', ['name' => 'priority', 'label' => 'Öncelik', 'options' => [['label' => 'Düşük', 'value' => 3], ['label' => 'Orta', 'value' => 2], ['label' => 'Yüksek', 'value' => 1]]])@endcomponent
                                                    @component('components.form.textarea', ['name' => 'body', 'label' => 'Ticket', 'richText' => true])@endcomponent
                                                    @component('components.form.select', ['name' => 'status', 'label' => 'Durum', 'options' => [['label' => 'Beklemede', 'value' => 'pending'], ['label' => 'Tamamlandı', 'value' => 'closed'], ['value' => 'in_progress', 'label' => 'İnceleniyor']]])@endcomponent
                                                    @component('components.form.select', ['name' => 'ticket_manager', 'label' => 'Atanan Kişi', 'options' => [['label' => '-', 'value' => null], ['label' => 'Elber', 'value' => 'Elber'], ['label' => 'Berat', 'value' => 'Berat'], ['label' => 'Alperen', 'value' => 'Alperen'], ['label' => 'Emin K.', 'value' => 'Emin K.']]])@endcomponent
                                                    @component('components.form.select', ['name' => 'is_active', 'label' => 'Aktiflik', 'options' => [['label' => 'Aktif', 'value' => true], ['label' => 'Pasif', 'value' => false]]])@endcomponent
                                                    @component('components.form.input', ['name' => 'estimated_deadline', 'label' => 'Tahmini Bekleme Süresi', 'type' => 'date'])@endcomponent
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
    </div>
@endsection
