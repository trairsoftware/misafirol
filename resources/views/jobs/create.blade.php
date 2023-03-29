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
                                <form method="POST" action="{{ url('jobs/edit/'. $ticket->id) }}"
                                      enctype="multipart/form-data">
                                    @method('PATCH')
                                    @else
                                        <form method="POST" action="{{ url('jobs/add') }}"
                                              enctype="multipart/form-data">
                                            @endif
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @component('components.form.input', ['name' => 'age', 'label' => 'Yaşınız'])@endcomponent
                                                    @component('components.form.select', ['name' => 'education_status', 'label' => 'Eğitim Durumunuz', 'options' => [['label' => 'İlkokul', 'value' => 'İlkokul'], ['label' => 'Ortaokul', 'value' => 'Ortaokul'], ['label' => 'Lise', 'value' => 'Lise'], ['label' => 'Üniversite', 'value' => 'Üniversite'], ['label' => 'Yüksek Lisans', 'value' => 'Yüksek Lisans'], ['label' => 'Diğer', 'value' => 'Diğer']]])@endcomponent
                                                    @component('components.form.select', ['name' => 'family_members', 'label' => 'Bakmakla yükümlü olduğunuz aile fertleri var mı? Varsa kaç kişi?', 'options' => [['label' => 'Yok', 'value' => '0'], ['label' => '1 Kişi', 'value' => '1'], ['label' => '2 Kişi', 'value' => '2'], ['label' => '3 Kişi', 'value' => '3'], ['label' => "3'ten Fazla", 'value' => '3+']]])@endcomponent
                                                    @component('components.form.select', ['name' => 'afad_registration', 'label' => 'Afad Kaydınızı Yaptırdınız mı?', 'options' => [['label' => 'Evet', 'value' => '1'], ['label' => 'Hayır', 'value' => '0']]])@endcomponent
                                                    @component('components.form.select', ['name' => 'earthquake_site', 'label' => 'Depreme Nerede Yakalandınız', 'options' => [['label' => 'Hatay', 'value' => 'Hatay'], ['label' => 'Adıyaman', 'value' => 'Adıyaman'], ['label' => 'Şanlıurfa', 'value' => 'Şanlıurfa'], ['label' => 'Gaziantep', 'value' => 'Gaziantep'], ['label' => 'Osmaniye', 'value' => 'Osmaniye'], ['label' => 'Kilis', 'value' => 'Kilis'], ['label' => 'Kahramanmaraş', 'value' => 'Kahramanmaraş'], ['label' => 'Malatya', 'value' => 'Malatya'], ['label' => 'Diyarbakır', 'value' => 'Diyarbakır'], ['label' => 'Adana', 'value' => 'Adana']]])@endcomponent
                                                    <label for="Iller">İş Aradığınız İl</label><select
                                                            class="form-control"
                                                            name="searched_province" id="Iller">
                                                        <option value="0">Lütfen Bir İl Seçiniz</option>
                                                    </select>
                                                    @component('components.form.input', ['name' => 'previous_occupation', 'label' => 'Önceki Mesleğiniz'])@endcomponent
                                                    @component('components.form.input', ['name' => 'Jobs_can_work', 'label' => 'Çalışabileceğiniz Alanlar'])@endcomponent
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
