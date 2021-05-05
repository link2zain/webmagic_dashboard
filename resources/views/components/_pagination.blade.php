@if ($paginated_items->hasPages())
    <div class="clearfix py-3">
        <ul class="pagination m-0" {!! $dynamic_fields !!}>
            <li class="page-item previous">
                <a href="#" class="page-link js_btn-pagination @if($paginated_items->currentPage() == 1)btn disabled @endif"
                   data-action="{{$action}}"
                   data-method="GET"
                   data-items="{{$per_page}}"
                   data-page="{{$paginated_items->currentPage() - 1}}"
                   data-replace-blk="{{$result_block_class}}">Prev</a>
            </li>
            @for($i=1; $i <= $paginated_items->lastPage(); $i++)
                @if ($i === $paginated_items->currentPage())
                    <li class="page-item active">
                        <a href="#"
                           class="page-link js_btn-pagination"
                           data-page="{{$i}}"
                           data-method="GET"
                           data-items="{{$per_page}}"
                           data-action="{{$action}}"
                           data-replace-blk="{{$result_block_class}}">{{ $i }}</a>
                    </li>
                @elseif(abs($paginated_items->currentPage() - $i) < 2 || $i <= 2 || ($paginated_items->lastpage() - $i) < 2)
                    <li class="page-item">
                        <a href="#"
                           class="page-link js_btn-pagination"
                           data-page="{{$i}}"
                           data-method="GET"
                           data-items="{{$per_page}}"
                           data-action="{{$action}}"
                           data-replace-blk="{{$result_block_class}}">{{ $i }}</a>
                    </li>
                @elseif(abs($paginated_items->currentPage() - $i) === 3)
                    <li class="page-item">
                        <a href="#"
                           class="page-link js_btn-pagination disabled"
                           data-action="{{$action}}"
                           data-items="{{$per_page}}"
                           data-page="{{$i}}"
                           data-method="GET"
                           data-replace-blk="{{$result_block_class}}">...</a>
                    </li>
                @endif
            @endfor
            <li class="page-item next">
                <a href="#" class="page-link js_btn-pagination @if($paginated_items->currentPage() == $paginated_items->lastPage())btn disabled @endif"
                   data-action="{{$action}}"
                   data-method="GET"
                   data-items="{{$per_page}}"
                   data-page="{{$paginated_items->currentPage() + 1}}"
                   data-replace-blk="{{$result_block_class}}">Next</a>
            </li>
        </ul>
    </div>
@endif
