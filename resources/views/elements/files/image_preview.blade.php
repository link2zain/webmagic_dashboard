<ul class="mailbox-attachments clearfix">
    <li>
        <span class="mailbox-attachment-icon has-img"><img src="{{$img_url}}@if($no_caching)?no-cache={{uniqid()}}@endif" alt=""></span>
        @if($file_name || $size || $download_url)
        <div class="mailbox-attachment-info">
            @if($file_name)
                <span class="mailbox-attachment-name" title="{{$file_name}}"  data-placement="bottom" ><i class="fas fa-camera"></i> {{$file_name}}</span>
            @endif
            <span class="mailbox-attachment-size clearfix mt-1">{{$size}}
            @if($download_url)
            <a href="{{$download_url}}" class="btn btn-default btn-xs float-right" download target="_blank">
                <i class="fas fa-cloud-download-alt"></i>
                </a>
            @endif
            </span>
        </div>
        @endif
    </li>
</ul>


