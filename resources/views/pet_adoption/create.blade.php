@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                İlan Oluştur
                            </div>
                        </div>
                        <div class="card-body">
                            @if (isset($action) && $action === 'edit')
                                <form method="POST" action="{{ url('need/edit/'. $ticket->id) }}"
                                      enctype="multipart/form-data">
                                    @method('PATCH')
                                    @else
                                        <form method="POST" action="{{ url('petadoption/add') }}"
                                              enctype="multipart/form-data">
                                            @endif
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @component('components.form.input', ['name' => 'title', 'label' => 'Başlık'])@endcomponent
                                                    <label for="Iller">İl</label><select class="form-control"
                                                                                         name="city" id="Iller">
                                                        <option value="0">Lütfen Bir İl Seçiniz</option>
                                                    </select>
                                                    <label for="Ilceler">İlçe</label><select class="form-control"
                                                                                             name="province"
                                                                                             id="Ilceler"
                                                                                             disabled="disabled">
                                                        <option value="0">Lütfen Önce bir İl seçiniz</option>
                                                    </select>
                                                    @component('components.form.textarea', ['name' => 'detail', 'label' => 'Detay', 'richText' => true])@endcomponent
                                                    @component('components.form.select', ['name' => 'status', 'label' => 'Durum', 'options' => [['label' => 'Açık', 'value' => 'open'], ['label' => 'Kapatıldı', 'value' => 'closed']]])@endcomponent
                                                    @component('components.form.select', ['name' => 'is_active', 'label' => 'Aktiflik', 'options' => [['label' => 'Aktif', 'value' => true], ['label' => 'Pasif', 'value' => false]]])@endcomponent
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
            integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
            crossorigin="anonymous"></script>

    <script src="{{asset('assets/js/city.js')}}"></script>
@endsection
