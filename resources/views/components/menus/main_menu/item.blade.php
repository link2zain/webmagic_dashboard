<li class="nav-item {{$item['class']}}  @if(isset($item['sub_items']) && count($item['sub_items'])) has-treeview @endif @if($item['open'] || $item['active']) menu-open @endif">
    <a class="nav-link @if($item['active']) active @endif" href="{{ $item['link'] ? url($item['link']) : url()->current() }}">
        <i class="nav-icon fas {{$item['icon']}}"></i>
        <p>{{$item['text']}}
            @if(isset($item['sub_items']) && count($item['sub_items']) )
                <i class="fas fa-angle-left right"></i>
            @endif
        </p>
    </a>

    @if(isset($item['sub_items']) && count($item['sub_items']))
        <ul class="nav nav-treeview" @if($item['open'] || $item['active']) style="display: block;" @endif>
            @each('dashboard::components.menus.main_menu.item', $item['sub_items'], 'item')
        </ul>
    @endif
</li>
