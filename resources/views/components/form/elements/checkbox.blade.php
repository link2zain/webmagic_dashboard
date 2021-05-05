<label @isset($style) style="{!! $style !!}" @endisset>
    <input
            id="{{$id}}"
            type="{{{ isset($type) ? $type : 'checkbox' }}}"
            class="{{$class}}"
            name="{{$name}}"
            value="{{$value}}"
            @if($checked) checked @endif
            @isset($select) data-select="{{$select}}" @endisset
            @isset($icheck) data-icheck="{{$icheck}}" @endisset
            @if($required) required="required" @endif
            {!!  $dynamic_fields !!}
    />
    {{$text}}
</label>
