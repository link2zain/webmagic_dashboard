<div class="{{$wrapper_classes}}">
    {!! $before_table !!}
    {{-- Filter --}}
    {!! $filter_area !!}
    <div class="table-responsive">
        <table class="{{$class}}" >
            <thead>
            {{-- Manual sorting --}}
            @if($manual_sorting_url)
                <th></th>
            @endif
            {{-- Select all checkbox --}}
            @if(!empty($bulk_actions_area))
                <th>
                    <input type="checkbox" id="checkbox-id-{{$bulk_actions_id}}" class="js_select-all checkbox" data-checked-el=".js_select-el-{{$bulk_actions_id}}">
                    <label for="checkbox-id-{{$bulk_actions_id}}" class="checkbox-lbl"></label>
                </th>
            @endif
            {{-- Titles --}}

            @foreach($titles as $title)
                @if($title instanceof \Webmagic\Dashboard\Elements\Tables\TableTitle)
                    {!! $title !!}
                @else
                    <th>{!! $title !!}</th>
                @endif
            @endforeach
            </thead>
            <tbody class="{{$tbody_class}}" data-url="{{$manual_sorting_url}}" data-method="{{$manual_sorting_method}}">
            {{-- Rows --}}
            {!! $rows !!}
            </tbody>
        </table>
    </div>
    {{-- Bulk actions --}}
    {!! $bulk_actions_area !!}
    {{-- Pagination --}}
    {!! $pagination_area !!}
    {!! $after_table !!}
</div>
