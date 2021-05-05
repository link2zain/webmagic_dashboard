<div class="input-group" {!!  $dynamic_fields !!}>
    <div class="@isset($group_class) {!! $group_class !!} @endisset">
        <div class="@isset($group_addon_class){{$group_addon_class}} @endisset">
            @isset($icon_addon)<i class=" fas {!! $icon_addon !!}"></i>@endisset
            @isset($group_addon_txt) {{$group_addon_txt}} @endisset
        </div>
    </div>
    {{--include view field--}}
    @isset($field_view)
        @include($field_view, $field_options)
    @endisset
</div>
