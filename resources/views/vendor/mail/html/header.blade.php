<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'S4YT')
<img src="{{asset('storage/logo.png')}}" class="logo" alt="S4YT Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
