<ul class="nav nav-tabs {{$class}}" {!! $dynamic_fields !!} role="tablist">
    @foreach($navigation_tabs as $tab)
        <li class="nav-item "><a href="#{{$tab->id}}" class="nav-link @if($tab->active) active @endif" data-toggle="pill" role="tab" aria-expanded="{{$tab->active}}">{{$tab->title}}</a></li>
    @endforeach
</ul>
