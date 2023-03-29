<body>
    <div id="app">
        <a href="https://api.whatsapp.com/send?phone=905414691919" class="float" target="_blank" style="	position:fixed;
	        width:60px;
	        height:60px;
	        bottom:40px;
	        right:40px;
	        background-color:#25d366;
	        color:#FFF;
	        border-radius:50px;
	        text-align:center;
            font-size:30px;
	        box-shadow: 2px 2px 3px #999;
            z-index:100;">
            <i class="fa fa-whatsapp my-float" style="	margin-top:16px;"></i>
        </a>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm hello">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('assets/images/misafirol.png') }}" width="150" alt="trair">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse d-md-flex justify-content: center;" style="margin-left: 50px;" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav m-auto mt-3 ">

                        @guest
                        @else
                        @if(Auth::user()->type === 'admin')

                        @component('components.nav-links',[
                        'url'=> url ('/post/list'),
                        'text'=> 'Aktif İlanlar'
                        ])@endcomponent

                        @component('components.nav-links',[
                        'url'=> url ('/request/list'),
                        'text'=> 'Aktif Talepler'
                        ])@endcomponent

                        @component('components.nav-links',[
                        'url'=> url ('/user/list'),
                        'text'=> 'Üyeler'
                        ])@endcomponent



                        @elseif(Auth::user()->type === 'owner')

                        @component('components.nav-links',[
                        'url'=> url ('/post/list'),
                        'text'=> 'Aktif İlanlarım'
                        ])@endcomponent

                        @component('components.nav-links',[
                        'url'=> url ('/petadoption/list'),
                        'text'=> 'Evcil Hayvan İlanlarım'
                        ])@endcomponent

                        @component('components.nav-links',[
                        'url'=> url ('my/need/requests/'),
                        'text'=> 'İhtiyaç Havuzu Başvurularım'
                        ])@endcomponent


                        @else
                        @component('components.nav-links',[
                        'url'=> url ('/request/list'),
                        'text'=> 'Aktif Taleplerim'
                        ])@endcomponent

                        @component('components.nav-links',[
                        'url'=> url ('/petadoption/list'),
                        'text'=> 'Evcil Hayvan İlanlarım'
                        ])@endcomponent

                        @component('components.nav-links',[
                        'url'=> url ('/need/list'),
                        'text'=> 'İhtiyaç Havuzu İlanlarım'
                        ])@endcomponent

                        @component('components.nav-links',[
                        'url'=> url ('/jobs/list'),
                        'text'=> 'İş İlanlarım'
                        ])@endcomponent


                        @endif
                        @endguest


                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto position-relative d-flex flex-col">
                        <div style="display: flex; flex-direction: row;">
                            <!-- Authentication Links -->
                            @guest
                            @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link mt-md-3" href="{{ route('login') }}">
                                    <button type="button" class="btn btn-outline-secondary">Giriş Yap</button>
                                </a></a>
                            </li>
                            @endif

                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link mt-md-3 " href="{{ route('register') }}">
                                    <button type="button" class="btn btn-outline-secondary">Kayıt Ol</button>
                                </a>
                            </li>
                            @endif
                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('user/detail/'. Auth::user()->id) }}">
                                        Profil Detayı
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        Çıkış Yap
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </div>
                    </ul>
                </div>
            </div>
        </nav>

    </div>
    <div>

        <nav class="navbar navbar-expand navbar-light bg-white shadow-sm hello  justify-content-center ">

            <div class=" container  justify-content-center d-flex ">
                <div>
                    <ul class="navbar-nav me-auto mt-3 w-100">
                        @component('components.nav-links',[
                        'url'=> url ('misafir-ol-nedir'),
                        'text'=> 'Misaifir Ol Nedir?'
                        ])@endcomponent

                        @component('components.nav-links',[
                        'url'=> url ('nasil-kullanirim'),
                        'text'=> 'Nasıl Kullanırım ?'
                        ])@endcomponent

                        @component('components.nav-links',[
                        'url'=> url ('destek-kanalları'),
                        'text'=> 'Destek Kanalları',
                        'target'=> ('_blank'),
                        ])@endcomponent

                    </ul>
                </div>
            </div>
        </nav>
    </div>





    <main class="py-4">