<button type="{{$type}}" class="btn {{ $class }}" {!! $dynamic_fields !!}>
    @if($icon) <i class="fas {{$icon}}"></i> @endif {!! $content !!}
</button>
