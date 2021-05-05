{{-- View for \Webmagic\Dashboard\Elements\Forms\Elements\DateTimePicker --}}
<div
    id="{{$id}}"
    class="input-group js_datetime_picker-blk" {!!  $dynamic_fields !!}>
    <input type="text"
           name="{{$name}}"
           class="form-control js_datetime_picker"
           data-time={{ $time ? "true" : "false" }}
           data-24-hour={{$time24format ? "true" : "false"}}
           data-seconds={{$seconds ? "true" : "false"}}
           data-date={{ $date ? "true" : "false" }}
           data-single={{ $range ? "false" : "true" }}
           data-ranges="true"
           data-format="{{$format}}"
           value="{{$value}}"
           readonly
            @if($required) required @endif
    />
    @if($range)
    <div class="input-group-addon px-2">to</div>
    <input type="text" name="{{$name_end}}"
           class="form-control js_datetime_picker-end"
           readonly
           value="{{$value_end}}"
           @if($required_end) required @endif
    />
    @endif
</div>
