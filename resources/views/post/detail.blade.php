@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                @if($post->is_institutional)
                                    Kurumsal İlan Detayı
                                @else
                                    İlan Detayı
                                @endif
                            </div>
                            <div>
                                <a class="btn btn-success" href="{{url('/')}}">Listeye Geri Dön</a>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (isset($action) && $action === 'detail')
                                <form method="POST" action="{{ url('post/edit/'. $post->id) }}"
                                      enctype="multipart/form-data">
                                    @method('PATCH')
                                    @else
                                        <form method="POST" action="{{ url('post/add') }}"
                                              enctype="multipart/form-data">
                                            @endif
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @component('components.form.input', ['name' => 'title', 'label' => 'Başlık', 'disabled' => 'disabled'])@endcomponent
                                                    @component('components.form.input', ['name' => 'city', 'label' => 'İl', 'disabled' => 'disabled'])@endcomponent
                                                    @component('components.form.input', ['name' => 'province', 'label' => 'İlçe', 'disabled' => 'disabled'])@endcomponent
                                                    @component('components.form.input', ['name' => 'capacity', 'label' => 'Kapasite', 'disabled' => 'disabled'])@endcomponent
                                                    @component('components.form.select', ['name' => 'gender_preference', 'label' => 'Cinsiyet Tercihi', 'disabled' => 'disabled', 'options' => [['label' => 'Yok', 'value' => 'no'], ['label' => 'Kadın', 'value' => 'female'], ['label' => 'Erkek', 'value' => 'male']]])@endcomponent
                                                    @component('components.form.select', ['name' => 'transport_assist', 'label' => 'Ulaşım Desteğiniz var mı?','disabled' => 'disabled', 'options' => [['label' => 'Hayır', 'value' => 0], ['label' => 'Evet', 'value' => 1]]])@endcomponent
                                                    @component('components.form.textarea', ['name' => 'detail', 'label' => 'Detay', 'disabled' => 'disabled', 'richText' => true])@endcomponent
                                                    @component('components.form.select', ['name' => 'status', 'label' => 'Durum', 'disabled' => 'disabled', 'options' => [['label' => 'Açık', 'value' => 'open'], ['label' => 'Kapatıldı', 'value' => 'closed']]])@endcomponent
                                                    @component('components.form.select', ['name' => 'is_active', 'label' => 'Aktiflik', 'disabled' => 'disabled', 'options' => [['label' => 'Aktif', 'value' => true], ['label' => 'Pasif', 'value' => false]]])@endcomponent
                                                    @isset(Auth::user()->type)
                                                        @if(Auth::user()->type === 'admin')
                                                            @component('components.form.textarea', ['name' => 'operation_comment', 'label' => 'Operatör Yorumu'])@endcomponent
                                                            @component('components.form.select', ['name' => 'is_called_type', 'label' => 'Arama Durumu', 'options' => [['label' => 'Arandı', 'value' => 'Arandı'], ['label' => 'Aranmadı', 'value' => 'Aranmadı'], ['label' => 'Meşgul', 'value' => 'Meşgul'], ['label' => 'Numara Kullanılmıyor', 'value' => 'Numara Kullanılmıyor'], ['label' => 'Ulaşılmıyor', 'value' => 'Ulaşılmıyor']]])@endcomponent
                                                        @endif
                                                    @endisset

                                                </div>
                                                <div class="form-group mt-2">
                                                    <label for="start_date">Konaklama Tarihi:</label><br>
                                                    {{$post->start_date ?? '-'}} / {{ $post->end_date ?? '-' }}
                                                </div>
                                            </div>
                                            <div class="text-right" style="margin-top: 1rem">
                                                @isset(Auth::user()->type)
                                                    @if(Auth::user()->type === 'admin')
                                                        <button type="submit" class="btn btn-success"> Yorumu  Kaydet</button>
                                                    @else
                                                        <a class="btn btn-success" href="{{url('/request/add/' . $post->id )}}">Misafir
                                                            Ol</a>
                                                    @endif
                                                @endisset

                                            </div>
                                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
