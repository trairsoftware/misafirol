<x-mail::message>
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# Merhaba,
@endif
@endif

{{-- Intro Lines --}}
Hesabınız için bir şifre sıfırlama talebi oluşturuldu.

{{-- Action Button --}}
@isset($actionText)
<?php
    $color = match ($level) {
        'success', 'error' => $level,
        default => 'primary',
    };
?>
<x-mail::button :url="$actionUrl" :color="$color">
Şifremi Kurtar
</x-mail::button>
@endisset

{{-- Outro Lines --}}
Bu linkin geçerlilik süresi 60 dakikadır.
Eğer bu işlem size ait değilse bu mesajı dikkate almayın.
{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
Sevgiler,<br>
MİSAFİR OL
@endif

{{-- Subcopy --}}
@isset($actionText)
<x-slot:subcopy>
@lang(
    "Eğer \"Şifremi Sıfırla\" butonuna tıklamada sorun yaşıyorsanız\n".
    'aşağıdaki linki kullanabilirsiniz.',
    [
        'actionText' => $actionText,
    ]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
</x-slot:subcopy>
@endisset
</x-mail::message>
