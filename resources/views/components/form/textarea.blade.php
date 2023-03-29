<div class="form-group {{$errors->has($name) ? 'has-error' : ''}}">
    <label for="{{$name}}">{{ __($label) }}</label>

    <textarea
            id="{{$name}}"
            type="{{isset($type) ? $type : 'text'}}"
            class="form-control @error($name) is-invalid @enderror @if(isset($richText) && $richText == true) ckeditor @endif"
            name="{{$name}}"
            placeholder="{{isset($placeholder) ? $placeholder : ''}}"
            @isset($disabled) disabled @endisset
    >{{ old($name) }}</textarea>
    @error($name)
    <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

@if(isset($richText) && $richText == true)
    @push('custom-scripts')
        <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
        <script type="text/javascript">

            $(document).ready(function () {
                $('.ckeditor').ckeditor();
            });
        </script>
    @endpush
@endif
