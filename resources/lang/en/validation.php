<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Doğrulama
    |--------------------------------------------------------------------------
    |
    | Aşağıdaki öğeler doğrulama(validation) işlemleri sırasında kullanılan varsayılan hata
    | mesajlarını içermektedir. `size` gibi bazı kuralların birden çok çeşidi
    | bulunmaktadır. Her biri ayrı ayrı düzenlenebilir.
    |
    */

    'accepted' => 'Kabul edilmelidir.',
    'accepted_if' => ':other :value olduğunda kabul edilmelidir.',
    'active_url' => 'Geçerli bir URL olmalıdır.',
    'after' => 'Geğeri :date tarihinden sonra olmalıdır.',
    'after_or_equal' => 'Değeri :date tarihinden sonra veya eşit olmalıdır.',
    'alpha' => 'Sadece harflerden oluşmalıdır.',
    'alpha_dash' => 'Sadece harfler, rakamlar ve tirelerden oluşmalıdır.',
    'alpha_num' => 'Sadece harfler ve rakamlar içermelidir.',
    'array' => 'Dizi olmalıdır.',
    'before' => 'Değeri :date tarihinden önce olmalıdır.',
    'before_or_equal' => 'Değeri :date tarihinden önce veya eşit olmalıdır.',
    'between' => [
        'numeric' => ':min - :max arasında olmalıdır.',
        'file' => ':min - :max arasındaki kilobayt değeri olmalıdır.',
        'string' => ':min - :max arasında karakterden oluşmalıdır.',
        'array' => ':min - :max arasında nesneye sahip olmalıdır.',
    ],
    'boolean' => 'Sadece doğru veya yanlış olmalıdır.',
    'confirmed' => 'Tekrarı eşleşmiyor.',
    'current_password' => 'Parola hatalı.',
    'date' => 'Geçerli bir tarih olmalıdır.',
    'date_equals' => 'Aynı tarihler olmalıdır.',
    'date_format' => ':format biçimi ile eşleşmiyor.',
    'declined' => 'Kabul edilmemelidir.',
    'declined_if' => ':other :value olduğunda kabul edilmemelidir.',
    'different' => ':other birbirinden farklı olmalıdır.',
    'digits' => ':digits haneden oluşmalıdır.',
    'digits_between' => ':min ile :max arasında haneden oluşmalıdır.',
    'dimensions' => 'Görsel ölçüleri geçersiz.',
    'distinct' => 'Yinelenen bir değere sahip.',
    'email' => 'Girilen e-posta adresi geçersiz.',
    'ends_with' => 'Şunlardan biriyle bitmelidir :values',
    'enum' => 'Seçili alan geçersiz.',
    'exists' => 'Seçili alan geçersiz.',
    'file' => 'Dosya olmalıdır.',
    'filled' => 'Alanının doldurulması zorunludur.',
    'gt' => [
        'numeric' => ':value değerinden büyük olmalı.',
        'file'    => ':value kilobayt boyutundan büyük olmalı.',
        'string'  => ':value karakterden uzun olmalı.',
        'array'   => ':value taneden fazla olmalı.',
    ],
    'gte' => [
        'numeric' => ':value kadar veya daha fazla olmalı.',
        'file'    => ':value kilobayt boyutu kadar veya daha büyük olmalı.',
        'string'  => ':value karakter kadar veya daha uzun olmalı.',
        'array'   => ':value tane veya daha fazla olmalı.',
    ],
    'image' => 'Resim dosyası olmalıdır.',
    'in' => 'Değeri geçersiz.',
    'in_array' => ':other içinde mevcut değil.',
    'integer' => 'Tamsayı olmalıdır.',
    'ip' => 'Geçerli bir IP adresi olmalıdır.',
    'ipv4' => 'Geçerli bir IPv4 adresi olmalıdır.',
    'ipv6' => 'Geçerli bir IPv6 adresi olmalıdır.',
    'json' => 'Geçerli bir JSON değişkeni olmalıdır.',
    'lt' => [
        'numeric' => ':value değerinden küçük olmalı.',
        'file'    => ':value kilobayt boyutundan küçük olmalı.',
        'string'  => ':value karakterden kısa olmalı.',
        'array'   => ':value taneden az olmalı.',
    ],
    'lte' => [
        'numeric' => ':value kadar veya daha küçük olmalı.',
        'file'    => ':value kilobayt boyutu kadar veya daha küçük olmalı.',
        'string'  => ':value karakter kadar veya daha kısa olmalı.',
        'array'   => ':value tane veya daha az olmalı.',
    ],
    'mac_address' => 'Geçerli bir MAC adresi olmalıdır.',
    'max' => [
        'numeric' => 'En çok :max olmalıdır.',
        'file' => 'Boyutu en çok :max kilobayt olmalıdır.',
        'string' => 'En çok :max karakter olmalıdır.',
        'array' => 'En çok :max nesneye sahip olmalıdır.',
    ],
    'mimes' => 'Dosya biçimi :values olmalıdır.',
    'mimetypes' => 'Dosya biçimi :values olmalıdır.',
    'min' => [
        'numeric' => 'Değeri en az :min olmalıdır.',
        'file' => 'Boyutu en az :min kilobayt olmalıdır.',
        'string' => 'En az :min karakter olmalıdır.',
        'array' => 'En az :min nesneye sahip olmalıdır.',
    ],
    'multiple_of' => ':value değerinin katları olmalıdır.',
    'not_in' => 'Seçili alan geçersiz.',
    'not_regex' => 'Biçimi geçersiz.',
    'numeric' => 'Sayı olmalıdır.',
    'password' => 'Parola geçersiz.',
    'present' => 'Mevcut olmalıdır.',
    'prohibited' => 'Gönderemezsiniz.',
    'prohibited_if' => ':other değeri :value olduğunda gönderemezsiniz.',
    'prohibited_unless' => 'Değerler\'de :other olmadığı sürece gönderemezsiniz.',
    'prohibits' => ':other alanını birlikte gönderemezsiniz.',
    'regex' => 'Biçimi geçersiz.',
    'required' => 'Boş geçilemez',
    'required_array_keys' => ':değerler için girişler içermelidir.',
    'required_if' => ':other :value değerine sahip olduğunda zorunludur.',
    'required_unless' => ':other alanı :value değerlerinden birine sahip olmadığında zorunludur.',
    'required_with' => ':values varken zorunludur.',
    'required_with_all' => 'Herhangi bir :values değeri varken zorunludur.',
    'required_without' => ':values yokken zorunludur.',
    'required_without_all' => ':values değerlerinden herhangi biri yokken zorunludur.',
    'same' => ':other eşleşmelidir.',
    'size' => [
        'numeric' => ':size olmalıdır.',
        'file' => ':size kilobyte olmalıdır.',
        'string' => ':size karakter olmalıdır.',
        'array' => ':size nesneye sahip olmalıdır.',
    ],
    'starts_with' => 'Şunlardan biri ile başlamalıdır: :values',
    'string' => 'Karekter olmalıdır.',
    'timezone' => 'Geçerli bir saat dilimi olmalıdır.',
    'unique' => 'Daha önceden kayıt edilmiş.',
    'uploaded' => 'Yüklemesi başarısız.',
    'url' => 'Biçimi geçersiz.',
    'uuid' => 'Bir UUID formatına uygun olmalı.',

    /*
    |--------------------------------------------------------------------------
    | Özelleştirilmiş doğrulama mesajları
    |--------------------------------------------------------------------------
    |
    | Bu alanda her niteleyici (attribute) ve kural (rule) ikilisine özel hata
    | mesajları tanımlayabilirsiniz. Bu özellik, son kullanıcıya daha gerçekçi
    | metinler göstermeniz için oldukça faydalıdır.
    |
    | Örnek:
    | 'invalid_extension'     => 'Dosyanın uzantısı geçersiz.',
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'Özelleşmiş Mesaj',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Özelleştirilmiş niteleyici isimleri
    |--------------------------------------------------------------------------
    |
    | Bu alandaki bilgiler "email" gibi niteleyici isimlerini "E-Posta adres"
    | gibi daha okunabilir metinlere çevirmek için kullanılır. Bu bilgiler
    | hata mesajlarının daha temiz olmasını sağlar.
    |
    | Örnek:
    |
    | 'email' => 'E-Posta adresi',
    | 'password' => 'Şifre',
    |
    */

    'attributes' => [],

];
