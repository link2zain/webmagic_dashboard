<dl class="@if($is_horizontal) dl-horizontal @endif" {!! $dynamic_fields !!}>
    @foreach($data as $title => $description)
        <dt>{!! $title !!}</dt>
        <dd>{!! $description !!}</dd>
    @endforeach
</dl>
