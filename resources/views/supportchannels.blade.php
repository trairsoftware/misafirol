@extends('layouts.app')

@section('content')
<div class="container my-3">
    <div class="row ">
        <div class="navbar navbar-expand navbar-light bg-white shadow-sm hello">
            <div class="container justify-content-center">
                <div>
                    <div class=" container ">
                        <ul class="m-auto ms-10 d-flex flex-wrap " style="list-style: none;">

                            @component('components.nav-links',[
                            'url'=> url ('https://www.otelz.com/tr/gecmisolsunturkiyem?fbclid=PAAaYrt-yJJD4iVHpO-cDhlQIQJMnwSdD_2NknlqTj9dVgU-8K_cFulE_ohy0'),
                            'text'=> 'Kalabileceğiniz Oteller',
                            'target'=> ('_blank'),
                            'buttonType'=> 'success'
                            ])@endcomponent

                            @component('components.nav-links',[
                            'url'=> url ('https://www.afetbilgi.com/G%C3%BCvenli%20Toplanma%20Alanlar%C4%B1'),
                            'text'=> 'Toplanma Alanları',
                            'target'=> ('_blank'),
                            'buttonType'=> 'success'
                            ])@endcomponent

                            @component('components.nav-links',[
                            'url'=> url ('https://www.afad.gov.tr/depremkampanyasi2'),
                            'text'=> 'Afad Banka Hesabı',
                            'target'=> ('_blank'),
                            'buttonType'=> 'success'
                            ])@endcomponent

                            @component('components.nav-links',[
                            'url'=> url ('https://ahbap.org/bagisci-ol'),
                            'text'=> 'Ahbap Derneği Banka Hesabı',
                            'target'=> ('_blank'),
                            'buttonType'=> 'success'
                            ])@endcomponent

                            @component('components.nav-links',[
                            'url'=> url ('mailto:destek@trair.com.tr'),
                            'text'=> 'İletişim: destek@trair.com.tr',
                            'target'=> ('_blank'),
                            'buttonType'=> 'success'
                            ])@endcomponent
                        </ul>
                    </div>
                    <div class="d-flex">
                        <ul class="m-auto mt-3 d-flex flex-wrap" style="list-style:none">
                            @component('components.nav-links',[
                            'url'=> url ('https://www.kizilay.org.tr/bagis-yontemleri/banka-yolu-ile-bagis/21'),
                            'text'=> 'Kızılay Banka Hesabı',
                            'target'=> ('_blank'),
                            'buttonType'=> 'success'
                            ])@endcomponent

                            @component('components.nav-links',[
                            'url'=> url ('https://www.akut.org.tr/bagis-yap'),
                            'text'=> 'Akut Banka Hesabı',
                            'target'=> ('_blank'),
                            'buttonType'=> 'success'
                            ])@endcomponent

                            @component('components.nav-links',[
                            'url'=> url ('https://www.flypgs.com/'),
                            'text'=> 'Pegasus Ulaşım',
                            'target'=> ('_blank'),
                            'buttonType'=> 'success'
                            ])@endcomponent

                            @component('components.nav-links',[
                            'url'=> url ('https://www.turkishairlines.com/tr-int/'),
                            'text'=> 'Türk Hava Yolları Ulaşım',
                            'target'=> ('_blank'),
                            'buttonType'=> 'success'
                            ])@endcomponent

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection