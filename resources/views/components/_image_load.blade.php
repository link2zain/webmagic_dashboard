{{--<div class="form-group">--}}
    {{--<div class="box">--}}
        {{--<div class="card-header with-border">--}}
            {{--<div class="card-title">{{$label}}</div>--}}
            {{--<div class="card-tools pull-right">--}}
                {{--<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>--}}
                {{--<label for="{{$name}}" class="btn btn-box-tool bg-green" data-toggle="tooltip" title="Изменить"><i class="fas fa-edit"></i></label>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="card-body js_media-preview-{{$name}}  @if(gettype($current_img) === 'array')img-gallery @endif">--}}
            {{--@if(gettype($current_img) === 'string' )--}}
                {{--<img class="img-responsive" src="{{$current_img}}" alt="">--}}
                {{--@if($show_details)--}}
                    {{--<p class="text-muted text-center"><small style="word-break: break-all;">{{basename($current_img)}}</small></p>--}}
                    {{--<p class="text-muted text-center"><small>{{$image_details[0]}}х{{$image_details[1]}}</small></p>--}}
                {{--@endif--}}
            {{--@else--}}
                {{--@if(count($current_img) > 0)--}}
                    {{--@foreach($current_img as $key => $img)--}}
                        {{--<div class="img-blk">--}}
                            {{--<img class="img-responsive" src="{{$img}}" alt="">--}}
                            {{--@if($show_details)--}}
                                {{--<p class="text-muted text-center"><small style="word-break: break-all;">{{basename($img)}}</small></p>--}}
                                {{--<p class="text-muted text-center"><small>{{$image_details[$key][0]}}х{{$image_details[$key][1]}}</small></p>--}}
                            {{--@endif--}}
                        {{--</div>--}}
                    {{--@endforeach--}}
                {{--@else--}}
                    {{--<div class="img-blk">--}}
                        {{--<img class="img-responsive" src="{{url('webmagic/dashboard/img/img-placeholder.png')}}" alt="">--}}
                    {{--</div>--}}
                {{--@endif--}}
            {{--@endif--}}
        {{--</div>--}}
        {{--{!! $form_builder->hidden($name . '_update') !!}--}}
        {{--{!! $form_builder->label($name, $label, ['class' => 'hidden']) !!}--}}
        {{--{!! $form_builder->file($name, $options) !!}--}}
    {{--</div>--}}
{{--</div>--}}

<div class="js_uploader"
     data-itemLimit="1"
     data-sizeLimit="1000"
     data-request-endpoint="/dashboard/blog/test"
     data-deleteFile-endpoint="/dashboard/blog/test"
     data-deleteFile-enabled="true">
</div>
<script type="text/template" id="qq-template">
    <div class="qq-uploader-selector qq-uploader" qq-drop-area-text="Drop files here">
        <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
            <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
        </div>
        <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
            <span class="qq-upload-drop-area-text-selector"></span>
        </div>
        <div class="qq-upload-button-selector qq-upload-button">
            <div>Upload a file</div>
        </div>
        <span class="qq-drop-processing-selector qq-drop-processing">
            <span>Processing dropped files...</span>
            <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
        </span>
        <ul class="qq-upload-list-selector qq-upload-list" aria-live="polite" aria-relevant="additions removals">
            <li>
                <div class="qq-progress-bar-container-selector">
                    <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>
                </div>
                <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                <img class="qq-thumbnail-selector" qq-max-size="100" qq-server-scale>
                <span class="qq-upload-file-selector qq-upload-file"></span>
                <span class="qq-edit-filename-icon-selector qq-edit-filename-icon" aria-label="Edit filename"></span>
                <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
                <span class="qq-upload-size-selector qq-upload-size"></span>
                <button type="button" class="qq-btn qq-upload-cancel-selector qq-upload-cancel">Cancel</button>
                <button type="button" class="qq-btn qq-upload-retry-selector qq-upload-retry">Retry</button>
                <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">Delete</button>
                <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
            </li>
        </ul>

        <dialog class="qq-alert-dialog-selector">
            <div class="qq-dialog-message-selector"></div>
            <div class="qq-dialog-buttons">
                <button type="button" class="qq-cancel-button-selector">Close</button>
            </div>
        </dialog>

        <dialog class="qq-confirm-dialog-selector">
            <div class="qq-dialog-message-selector"></div>
            <div class="qq-dialog-buttons">
                <button type="button" class="qq-cancel-button-selector">No</button>
                <button type="button" class="qq-ok-button-selector">Yes</button>
            </div>
        </dialog>

        <dialog class="qq-prompt-dialog-selector">
            <div class="qq-dialog-message-selector"></div>
            <input type="text">
            <div class="qq-dialog-buttons">
                <button type="button" class="qq-cancel-button-selector">Cancel</button>
                <button type="button" class="qq-ok-button-selector">Ok</button>
            </div>
        </dialog>
    </div>
</script>


{{--<form action="/test">--}}
    {{--<div class="js_uploader" data-img-qty="1"></div>--}}
{{--</form>--}}
