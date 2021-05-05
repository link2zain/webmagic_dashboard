{{-- View for element Webmagic\Dashboard\Elements\Forms\Elements\DateDropdown --}}
// TODO Check the functionality

{{--<select
        id="{{$id}}"
        name="{{$name}}"
        class="form-control  {{$classes}}"
        @if($multiple) multiple @endif
        data-placeholder="{{$placeholder}}"
        @if($required) required @endif
>
        <option value="null">None</option>
    @foreach($options as $key => $val)
        <option value="{{$key}}" @if($key == $selected_key) selected @endif >{{$val}}</option>
    @endforeach
        <option value="null" >Custom range</option>
</select>--}}


<div id="inp-1" class="input-group js_datetime_picker-blk" {!!  $dynamic_fields !!}>
    <input type="text"
           name="date-start"
           class="form-control js_datetime_picker"
           data-time="true"
           data-seconds="true"
           data-date="true"
           data-single="false"
           data-ranges="true"
           data-format="Y-MM-DD HH:mm:ss"
           data-24-hour="true"
           value=""
           required
    />
    <div class="input-group-addon px-2">to</div>
    <input type="text" name="date-end"
           class="form-control js_datetime_picker-end"
           disabled
           value=""
           required
    />
</div>
