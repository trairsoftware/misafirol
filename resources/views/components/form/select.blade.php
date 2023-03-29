<div class="form-group {{$errors->has($name) ? 'has-error' : ''}}">
    <label for="{{$name}}">{{ __($label) }}</label>

    <select
            id="{{$name}}"
            type="{{isset($type) ? $type : 'text'}}"
            class="form-control @error($name) is-invalid @enderror"
            name="{{$name}}"
            @isset($disabled) disabled @endisset
    >
        @isset($placeholder)
            <option selected disabled>{{__($placeholder)}}</option>
        @endisset
        @foreach($options as $option)
            <option @if(old($name) === $option['value']) selected @endif value="{{$option['value']}}">{{__($option['label'])}}</option>
        @endforeach
    </select>
    @error($name)
    <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
