<ol class="breadcrumb">
    @foreach ($data as $item)
        @if(!$loop->last)
            <li>
                <a href="{{$item['link']}}">
                    @if($item['icon'] !== '') <i class="fas {{$item['icon']}}"></i>@endif {{$item['text']}}
                </a>
            </li>
        @else
            <li class="active">{{$item['text']}}</li>
        @endif
    @endforeach
</ol>
