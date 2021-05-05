<form action="{{$action}}" method="{{$method}}" id="{{$id}}" data-replace-blk="#myformID" {!! $dynamic_fields !!}>
    <div class="card box-default">
        <div class="card-header with-border">
            <h3 class="card-title">{{$title}}</h3>
            <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="card-body">
            <img class="img-responsive pad " src="{{$img_url}}@if($no_caching)?no-cache={{uniqid()}}@endif" alt="Photo" @if(!$img_url) style="display: none;" @endif>
            <div class="mailbox-attachment-icon" @if($img_url) style="display: none;" @endif>
                <i class="fas fa-image"></i>
            </div>
            <div class="text-center">
                @if($file_name)<div class="image-name" title="{{$file_name}}" data-placement="bottom" >{{$file_name}}</div>@endif
                @if($width && $height)<div class="image-size">{{$width}} x {{$height}} px</div>@endif
                @if($size)<div class="image-size">{{$size}}</div>@endif
            </div>
        </div>
        <div class="card-footer text-center">
            <div class="btn-group">
                @if($download_url)<a href="{{$download_url}}" type="button" class="btn btn-flat btn-info" download ><i class="fas fa-download"></i></a> @endif($download_url)
                <button type="button" class="btn  btn-flat btn-success btn-file">
                    <i class="fas fa-edit"></i>
                    <input type="file" name="{{$name}}" class="js_submit-form-by-change-el" accept="image/*" data-form="#myformID">
                </button>
                <button type="button" class="btn  btn-flat btn-danger js_ajax-by-click-btn"
                        data-action="{{$delete_action}}"
                        data-replace-blk="#{{$id}}"
                        data-method="{{$delete_method}}"><i class="fas fa-trash-alt"></i></button>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
</form>
