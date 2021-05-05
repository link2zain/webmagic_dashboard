

<div class="form-group {!! $class !!}" {!!  $dynamic_fields !!}>
    @if(strlen($label_txt))<label for="{{$label_id}}">{{$label_txt}}</label>@endif

    @if(@isset($wrap_field) && $wrap_field != "")
        <span class="{{$wrap_field}}">
            {!! $form_group_content !!}
        </span>
    @else
            {!! $form_group_content !!}
    @endif
</div>
