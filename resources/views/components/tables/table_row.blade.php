@foreach($items as $key => $row)
    <tr class="@isset($row_classes_array[$key]) {{$row_classes_array[$key]}} @else {{$classes}} @endif"
        @if(!empty($attributes_closures_array)) {{$attributes_closures_array[$key]}}@endif
        @if(isset($row['manual_sorting_id'])) id="{{$row['manual_sorting_id']}}" @endif
    >
        {{-- Manual sorting --}}
        @if(isset($row['manual_sorting_id']))
            <td class="js-sortable-handler"><i class="fas fa-arrows-alt-v"></i> </td>
        @endif

        @if(isset($row['bulk_action_id']))
            <td>
                <input  name="ids[]" value="{{$row['bulk_action_id']}}" type="checkbox"
                        id="checkbox-id-{{$row['bulk_action_id']}}" class="js_select-el-{{$bulk_actions_id}} checkbox">
                <label for="checkbox-id-{{$row['bulk_action_id']}}" class="checkbox-lbl"></label>
            </td>
        @endif

        @foreach($row as $key => $field)
            @if( !in_array($key, ['bulk_action_id', 'manual_sorting_id']) )
            <td>{!! $field !!}</td>
            @endif
        @endforeach
    </tr>
@endforeach
