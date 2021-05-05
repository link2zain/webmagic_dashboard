<div class="btn-group {{$class}}">
    <a href="{{$link}}" type="button" class="btn btn-flat {!! $button_class !!}">
        @isset($icon) <i class="fas {{$icon}}"></i> @endisset {!! $content !!}
    </a>
    <button type="button" class="btn btn-flat {!! $button_class !!} dropdown-toggle" data-toggle="dropdown">
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu" role="menu">
        @foreach($items as $item)
            {!! $item !!}
        @endforeach
    </ul>
</div>
