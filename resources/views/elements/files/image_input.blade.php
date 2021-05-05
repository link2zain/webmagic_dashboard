<div {!! $dynamic_fields !!}>
<div class="card box-default js_ui-file-preview">
    <div class="card-header with-border">
        <h3 class="card-title">{{$title}}</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="card-body">
        <img class="img-responsive pad js_ui-input-file-preview" src="{{$img_url}}" alt="Photo" @if(!$img_url)style="display: none;"@endif>
        <div class="mailbox-attachment-icon js_ui-input-file-default-img" @if($img_url)style="display: none;"@endif>
            <i class="fas fa-image"></i>
        </div>
        <div class="text-center">
            @if($file_name)<div class="image-name js_ui-input-file-name" title="{{$file_name}}" data-placement="bottom" >{{$file_name}}</div>@endif
            @if($width && $height)<div class="image-size js_ui-input-file-size-with-height">{{$width}} x {{$height}} px</div>@endif
            @if($size)<div class="image-size js_ui-input-file-size">{{$size}}</div>@endif
        </div>
    </div>
    <div class="card-footer text-center">
        <div class="btn-group">
            @if($download_url)<a href="{{$download_url}}"  class="btn  btn-info js_ui-input-file-download" download ><i class="fas fa-download"></i></a>@endif
            <div class="btn  btn-success btn-file">
                <i class="fas fa-edit"></i>
                <input type="file" name="{{$name}}" class="js_ui-input-file" accept="image/*">
            </div>
            <button type="button" class="btn  btn-danger js_ui-input-file-delete"><i class="fas fa-trash-alt"></i></button>
        </div>
    </div>
    <!-- /.box-body -->
</div>
</div>
