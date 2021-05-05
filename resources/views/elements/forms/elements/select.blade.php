<select
        id="{{$id}}"
        name="{{$name}}"
        class="{{$class}}"
        @if($multiple) multiple @endif
        data-placeholder="{{$placeholder}}"
        @if($required) required @endif        
        {!! $dynamic_fields !!}
>
        @foreach($options as $key => $val)
            <option value="{{$key}}" @if(in_array($key, $selected_keys)) selected @endif >{{$val}}</option>
        @endforeach
</select>
