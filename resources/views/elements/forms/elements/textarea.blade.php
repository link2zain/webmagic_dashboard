<textarea
        id="{{$id}}"
        class="{{$class}}"
        name="{{$name}}"
        cols="{{$cols}}"
        rows="{{$rows}}"
        title="{{$title}}"
        placeholder="{{$placeholder}}"
        @if($required) required="required" @endif
        {!!  $dynamic_fields !!}
>{!! $content !!}</textarea>
