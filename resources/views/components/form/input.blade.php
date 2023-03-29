<div class="form-group {{$errors->has($name) ? 'has-error' : ''}}">
    @if(isset($label))
        <label for="{{$name}}">{{ __($label) }}</label>
    @endif

    <input
            id="{{$name}}"
            type="{{isset($type) ? $type : 'text'}}"
            class="form-control @error($name) is-invalid @enderror"
            name="{{$name}}"
            value="@if(old($name)){{old($name)}}@elseif(isset($default)){{$default}}@endif"
            placeholder="{{isset($placeholder) ? $placeholder : ''}}"
            @isset($disabled) disabled @endisset
            maxlength="{{isset($maxlength) ? $maxlength : ''}}"
    >
    @isset($smallMsg)
    <small class="form-text text-muted">{{$smallMsg}}</small>
    @endisset

    @error($name)
    <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
