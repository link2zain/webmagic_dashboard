<th>{{$title}}
    <a href="#" class="text-muted js_ajax-by-click-btn"
       data-sort-by="{{$sort_by}}"
       data-sort="{{$next_sort}}"
       data-action="{{$action}}"
       data-method="{{$method}}"
       data-replace-blk="{{$result_replace_block_class}}">
        @if($current_sort == 'asc')
            <i class="fas fa-sort-amount-down-alt" title="Sorting switcher"></i>
        @elseif($current_sort == 'desc')
            <i class="fas fa-sort-amount-up-alt" title="Sorting switcher"></i>
        @else
            <i class="fas fa-fw fa-sort" title="Sorting switcher"></i>
        @endif
    </a>
</th>
