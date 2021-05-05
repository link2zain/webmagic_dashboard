<a href="{{$link}}" class="btn btn-flat js_delete {{$classes}}" data-item=".{{$item_class}}" data-request="{{$request_uri}}"
   data-method="{{$method}}" {!! $dynamic_fields !!}>
    @isset($icon) <i class="fas {{$icon}}"></i> @endisset @isset($content) {!! $content !!} @endisset
</a>
