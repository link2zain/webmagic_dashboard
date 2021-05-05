<form class="{{ $class }} @if($horizontal) form-horizontal @endif @if($ajax_form) js-submit @endif"
      action="{{$action}}"
      method="{{$method}}"
      @if($send_all_checkbox) data-send-all-checkbox="{{$send_all_checkbox}}" @endif
      @if($result_block_class) data-result="{{$result_block_class}}" @endif
      @if($result_replace_block_class) data-replace-blk="{{$result_replace_block_class}}" @endif
      @if(!$success_notifications)  data-success-msg="false" @endif
      @if(!$error_notifications)  data-error-msg="false" @endif
      @if(!$status_message) data-status="false" @endif

       {!! $dynamic_fields !!}
>

    {{ csrf_field() }}
    {{ method_field($realMethod) }}

    {!! $form_content !!}


</form>

