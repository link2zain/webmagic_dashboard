<input
        id="{{$id}}"
        class="{{$class}}"
        type="{{$type}}"
        placeholder="{{ $placeholder }}"
        value="{{$value !== '' ? $value : old($name)}}"
        name="{{$name}}"

        @if($required) required="required" @endif

        {!!  $dynamic_fields !!}
/>
