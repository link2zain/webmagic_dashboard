<input type="checkbox"
       id="{{$id}}"
       class="switch-inp {{$class}}"
       name="{{$name}}"
       value="{{$value}}"
       @if($checked) checked @endif
       @if($required) required @endif
      {!!  $dynamic_fields !!}
>
<label class="switch {{$label_class}}" for="{{$id}}" style="width: {{$width}}px; height: {{$height}}px;">
    <span class="switch-slider {{$background}}"></span>
</label>
