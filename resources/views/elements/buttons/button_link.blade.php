<button type="button" class="btn-link p-0 {!! $class !!}">
    @isset($iconFirst) <i class="margin-r-5 fas {{$iconFirst}}"></i> @endisset @isset($content){!! $content !!}@endisset
    @isset($iconLast) <i class="fas {{$iconLast}}"></i>@endisset
</button>
