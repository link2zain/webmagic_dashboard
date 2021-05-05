<div class="card @if($solid) box-solid @endif box-{{$color_type}} {{$class}}" {!! $dynamic_fields !!}>
    @if($header_available)
        <div class="card-header clearfix">
            <h3 class="card-title @if($box_tools) float-left @endif" >{!! $box_title !!}</h3>
            {!! $box_header_content !!}
            <div class="float-right">
                {!! $box_tools !!}
            </div>
        </div>
    @endif
    <div class="card-body {{$box_body_classes}}">
        {!! $box_body !!}
    </div>
    @if($footer_available)
        <div class="card-footer">
            {!! $box_footer !!}
        </div>
    @endif
</div>
