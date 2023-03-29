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
                                <a class="btn btn-success" href="{{url('/jobs')}}">Listeye Geri Dön</a>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (isset($action) && $action === 'edit')
                                <form method="POST" action="{{ url('jobs/edit/'. $job->id) }}"
                                      enctype="multipart/form-data">
                                    @method('PATCH')
                                    @else
                                        <form method="POST" action="{{ url('jobs/add') }}"
                                              enctype="multipart/form-data">
                                            @endif
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @component('components.form.input', ['name' => 'name', 'label' => 'İsim', 'disabled' => 'disabled'])@endcomponent
                                                    @if($is_request)
                                                        @component('components.form.input', ['name' => 'phone_number', 'label' => 'Telefon Numarası', 'disabled' => 'disabled'])@endcomponent
                                                        @component('components.form.input', ['name' => 'email', 'label' => 'Mail Adresi', 'disabled' => 'disabled'])@endcomponent
                                                    @endif
                                                        @component('components.form.input', ['name' => 'age', 'label' => 'Yaş', 'disabled' => 'disabled'])@endcomponent

                                                    @component('components.form.input', ['name' => 'education_status', 'label' => 'Eğitim Durumunuz', 'disabled' => 'disabled'])@endcomponent
                                                    @component('components.form.select', ['name' => 'family_members', 'disabled' => 'disabled', 'label' => 'Bakmakla yükümlü olduğunuz aile fertleri var mı? Varsa kaç kişi?', 'options' => [['label' => 'Yok', 'value' => '0'], ['label' => '1 Kişi', 'value' => '1'], ['label' => '2 Kişi', 'value' => '2'], ['label' => '3 Kişi', 'value' => '3'], ['label' => "3'ten Fazla", 'value' => '3+']]])@endcomponent
                                                        @component('components.form.select', ['name' => 'afad_registration', 'disabled' => 'disabled', 'label' => 'Afad Kaydınızı Yaptırdınız mı?', 'options' => [['label' => 'Evet', 'value' => '1'], ['label' => 'Hayır', 'value' => '0']]])@endcomponent
                                                    @component('components.form.input', ['name' => 'earthquake_site', 'label' => 'Depreme Nerede Yakalandınız ? ', 'disabled' => 'disabled'])@endcomponent
                                                    @component('components.form.input', ['name' => 'searched_province', 'label' => 'İş Aradığınız İl', 'disabled' => 'disabled'])@endcomponent
                                                        @component('components.form.input', ['name' => 'previous_occupation', 'label' => 'Önceki Mesleğiniz',  'disabled' => 'disabled'])@endcomponent
                                                        @component('components.form.input', ['name' => 'Jobs_can_work', 'label' => 'Çalışabileceğiniz Alanlar',  'disabled' => 'disabled'])@endcomponent
                                                    @component('components.form.select', ['name' => 'status', 'label' => 'Durum', 'disabled' => 'disabled', 'options' => [['label' => 'Açık', 'value' => 'open'], ['label' => 'Kapatıldı', 'value' => 'closed']]])@endcomponent
                                                    @component('components.form.select', ['name' => 'is_active', 'label' => 'Aktiflik', 'disabled' => 'disabled', 'options' => [['label' => 'Aktif', 'value' => true], ['label' => 'Pasif', 'value' => false]]])@endcomponent
                                                </div>
                                            </div>
                                            <div class="text-right" style="margin-top: 1rem">
                                                <a class="btn btn-success" href="{{url('jobs/request/add/' . $job->id )}}">Başvuruda Bulun</a>
                                            </div>
                                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
