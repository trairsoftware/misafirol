@extends('layouts.app')

@section('content')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Kayıt Ol</div>

                    <div class="card-body">
                        <form method="POST" id="register_form" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="membership_type" class="col-md-4 col-form-label text-md-end">Üyelik
                                    Tipi</label>
                                <div class="col-md-6">
                                    <input class="form-check-input" style="margin-right: 5px"
                                           onchange="onChangeFunction()"
                                           id="membership_type_2"
                                           name="is_instution"
                                           type="radio" value="false" checked><label for="Individual">Bireysel
                                        Üyelik </label>
                                    <input class="form-check-input" style="margin-left: 5px; margin-right: 5px;"
                                           onchange="onChangeFunction()"
                                           id="membership_type"
                                           name="is_instution"
                                           type="radio" value="true"
                                    ><label for="institutional">Kurumsal Üyelik </label>

                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">İsim</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div id="tc" style="display: block">
                                <div class="row mb-3">
                                    <label for="tc_no" class="col-md-4 col-form-label text-md-end">TC NO</label>

                                    <div class="col-md-6">

                                        <input id="tc_no" type="text"
                                               class="form-control @error('tc_no') is-invalid @enderror" name="tc_no"
                                               value="{{ old('tc_no') }}" required>
                                        <span style="font-size: 10px">T.C. kimlik numarası sadece gerekli durumlarda resmi makamlarla paylaşılacaktır. Bunun dışında bir amaç için kesinlikle kullanılmayacaktır.</span>

                                        @error('tc_no')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div id="company_name_div" style="display: none">
                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-form-label text-md-end">Kurum Adi</label>

                                    <div class="col-md-6">
                                        <input id="company_name" type="text"
                                               class="form-control" name="company_name"
                                               value="" required autocomplete="name" autofocus>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">E-Mail</label>
                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="phone_number" class="col-md-4 col-form-label text-md-end">GSM</label>

                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" disabled value="+90" id="inputZip">
                                        </div>
                                        <div class="col-md-9">
                                            <input id="phone_number" type="tel" placeholder="xxx xxx xx xx"
                                                   maxlength="10"
                                                   class="form-control @error('phone_number') is-invalid @enderror"
                                                   name="phone_number" value="{{ old('phone_number') }}" required>
                                        </div>
                                    </div>
                                    @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="city" class="col-md-4 col-form-label text-md-end">İkamet Şehri</label>

                                <div class="col-md-6">
                                    <select class="form-control"
                                            name="city" id="Iller">
                                        <option value="0">Lütfen Bir İl Seçiniz</option>
                                    </select>

                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="city" class="col-md-4 col-form-label text-md-end">İkamet İlçesi</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="district" id="Ilceler"  disabled="disabled">
                                        <option value="0">Lütfen Önce bir İl seçiniz</option>
                                    </select>

                                    @error('district')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="type" class="col-md-4 col-form-label text-md-end">Üyelik Amacı</label>

                                <div class="col-md-6">
                                    <select id="type" class="form-control @error('type') is-invalid @enderror()"
                                            name="type" required>
                                        <option value="" selected disabled>Lütfen Seçiniz...</option>
                                        <option value="owner" @if(old('type')=="owner" ) {{ 'selected' }} @endif>Misafir Etmek</option>
                                        <option value="guest" @if(old('type')=="guest" ) {{ 'selected' }} @endif>Misafir Olmak</option>
                                    </select>
                                    @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div id='institutional_div' style="display: none">
                                <div class="row mb-3">
                                    <label for="tax_number" class="col-md-4 col-form-label text-md-end">Vergi Numarası /
                                        Dairesi</label>

                                    <div class="col-md-6" style="display: grid; grid-template-columns: 195px 195px">

                                        <input id="tax_number" type="text" placeholder="Vergi Numarası"
                                               class="form-control " name="tax_number"
                                               value="" required>
                                        <input id="tax_adminastration" style="margin-left: 7.5px" type="text"
                                               class="form-control" placeholder="Vergi Dairesi"
                                               name="tax_adminastration"
                                               value="" required>

                                        @error('tax_number')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                        @error('tax_adminastration')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="instution_type" class="col-md-4 col-form-label text-md-end">Kurum
                                        Türü</label>

                                    <div class="col-md-6">
                                        <select id="instution_type" class="form-control"
                                                name="instution_type" required>
                                            <option value="" selected disabled>Lütfen Seçiniz...</option>
                                            <option value="Oteller">Oteller</option>
                                            <option value="Apartlar">Apartlar</option>
                                            <option value="Belediyeler">Belediyeler</option>
                                            <option value="Öğretmen Evleri">Öğretmen Evleri</option>
                                            <option value="Polis Evleri">Polis Evleri</option>
                                            <option value="Yurtlar">Yurtlar</option>
                                            <option value="Spor Klüpleri">Spor Klüpleri</option>
                                        </select>
                                        @error('instution_type')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">Şifre</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Şifre
                                    (tekrar)</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end"></label>

                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                               onchange="document.getElementById('grabaperaus').disabled = !this.checked;"
                                               value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            <a href="{{url('/aydinlatma-metni')}}">Aydınlatma metnini
                                                okudum</a> onaylıyorum
                                        </label>
                                    </div>
                                    <div class="g-recaptcha"
                                         data-sitekey="6LemFGUkAAAAAHSoiB_Zl9nHSrvoz3tbRT6ADI1K"></div>
                                </div>
                            </div>


                            <script>
                                grecaptcha.ready(function () {
                                    grecaptcha.execute('6LemFGUkAAAAAHSoiB_Zl9nHSrvoz3tbRT6ADI1K', {action: 'submit'}).then(function (token) {
                                    });
                                });
                            </script>
                        </form>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary g-recaptcha" onclick="submitForm()"
                                        disabled name="grabaperaus" id="grabaperaus">
                                    Kayıt Ol
                                </button>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function submitForm() {
            var response = grecaptcha.getResponse();
            if (response.length === 0) {
                console.log('Un Verified');
            } else {
                document.getElementById("register_form").submit();
            }

            console.log(document.getElementById('tc_no').value);
            console.log("document.getElementById('tc_no').value");
        }

        function onChangeFunction() {
            var membership_type = document.getElementById('membership_type').checked;
            var membership_type_2 = document.getElementById('membership_type_2').checked;

            if (membership_type) {
                document.getElementById('institutional_div').style.display = "block";
                document.getElementById('company_name_div').style.display = "block";
                document.getElementsByName('is_instution').value = true;
            } else if (membership_type_2) {
                document.getElementById('company_name_div').style.display = "none";
                document.getElementById('institutional_div').style.display = "none";

                document.getElementById('company_name').value = "";
                document.getElementById('tax_number').value = "";
                document.getElementById('tax_adminastration').value = "";
                document.getElementById('instution_type').value = "";
                document.getElementsByName('is_instution').value = false;
            }
        }


    </script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
            async defer>
    </script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
            integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
            crossorigin="anonymous"></script>

    <script src="{{asset('assets/js/city.js')}}"></script>
@endsection
