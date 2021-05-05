<div class="{!! $class !!}" {!! $dynamic_fields !!}>
{!! $before_grid !!}
<div class="row {{$row_class}}">
    @foreach ($elements as $element)
        <div class="col-xs-{{$xs}} col-sm-{{$sm}} col-md-{{$md}} col-lg-{{$lg}}">
            {!! $element !!}
        </div>
        @if ($loop->iteration == $xs_row_count)
            <div class="clearfix visible-xs-block"></div>
        @endif
        @if ($loop->iteration == $sm_row_count)
            <div class="clearfix visible-sm-block"></div>
        @endif
        @if ($loop->iteration == $md_row_count)
            <div class="clearfix visible-md-block"></div>
        @endif
        @if ($loop->iteration == $lg_row_count)
            <div class="clearfix visible-lg-block"></div>
        @endif
    @endforeach
</div>
{!! $after_grid !!}
</div>
