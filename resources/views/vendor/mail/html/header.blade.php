@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://misafirol.org/assets/images/misafirol.png" class="logo" alt="Misafir Ol Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
