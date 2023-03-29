@extends('layouts.app')

@section('content')
<div class="container my-3">
    <div class="row ">
        <div class="navbar navbar-expand-md navbar-light bg-white shadow-sm hello"
            style="background-color:rgb( 255 , 241 , 194 );color:rgb( 83 , 61 , 5 );font-size:16px;line-height:normal; ">
            <div class="container alert alert-warning">
                <div>
                    <p style="margin:0px">— Bu bir sosyal sorumluluk projesidir. Bilgileriniz KVKK güvencesiyle saklanmaktadır.
                        —</p>
                    <p style="min-height:19px margin:0px"><br></p>
                    <p style="margin:0px"><b>Bu proje nasıl çalışıyor?&nbsp;</b></p>
                    <p style="margin:0px">Sistemde iki tip kullanıcı var: Ev sahibi ve ihtiyaç sahibi.</p>
                    <p style="min-height:19px ;margin:0px"><br></p>
                    <p style="margin:0px"><b>Ev sahibi iseniz;&nbsp;</b></p>
                    <p style="margin:0px">Evinizi ihtiyaç sahipleri ile paylaşan konumdasınız. Evlerinizi misafirlere açmak
                        istiyorsanız öncelikle ‘Kullanıcı Aydınlanma Metni’ni ve KVKK metnini okuyup onaylamanız gerekiyor. Sms
                        yoluyla gerçekleşecek olan onay işleminden sonra ‘ilan talep formu’nu doldurup talebinizi kolaylıkla
                        oluşturabilirsiniz.&nbsp;</p>
                    <p style="min-height:19px ;margin:0px"><br></p>
                    <p style="margin:0px"><b>İhtiyaç sahibi iseniz;</b></p>
                    <p style="margin:0px">Sms onayı ve bilgilendirme metinlerini okuyup kullanıcı kaydını oluşturun. Daha sonra
                        kendinize uygun gördüğünüz ilanı okuyup, 'misafir ol' butonuna tıklayın.&nbsp;</p>
                    <p style="margin:0px">Bu islem sonunda ev sahibi olan kullanıcıya bildiri gider. Bu bildiride ayni zamanda
                        ihtiyaç sahibinin iletişim bilgileri de yer alır. &nbsp;</p>
                    <p style="min-height:19px"><br></p>
                    <p style="margin:0px">Bu asamadan sonra gerek platform üzerinden, gerekse iletişim numarasından karşılıklı
                        görüşme sağlayabilirsiniz. İki tarafın da anlaşmasından sonra ihtiyaç sahibini evinizde misafir
                        edebilirsiniz.&nbsp;
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection