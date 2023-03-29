<li class="nav-item m-auto ">
    <a class="nav-link " href="{{ $url ?? '#' }}" target="{{isset($target) ? $target:'_self' }}">
        <button type="button" class="btn btn-outline-{{$buttonType ?? 'dark'}}" >
            {{$text ?? ''}}
        </button>
    </a>
</li>
