<div class="form-group {{$errors->has($name) ? 'has-error' : ''}}">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" id="{{$name}}" name="{{$name}}" @if(old($name)) checked @endif>
        <label class="custom-control-label" for="{{$name}}">{{ __($label) }}</label>
    </div>
</div>
