<a href="{{ $link }}" class="btn {{$class}}" {!! $dynamic_fields !!}>
    @isset($icon) <i class="fas {{$icon}}"></i> @endisset @isset($content) {!! $content !!} @endisset
</a>
