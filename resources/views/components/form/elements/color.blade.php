<input
        id="{{$id}}"
        class="{{$class}}"
        type="{{$type}}"
        value="{{$value ? $value : old($name)}}"
        name="{{$name}}"
        @if($required) required="required" @endif
        {!! $dynamic_fields !!}
/>
