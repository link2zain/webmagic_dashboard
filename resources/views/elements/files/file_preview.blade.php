<ul class="mailbox-attachments clearfix">
    <li>
        <span class="mailbox-attachment-icon"><i class="{{$icon}}"></i></span>

        <div class="mailbox-attachment-info">
            @if($name)
                <span class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> {{$name}}</span>
            @endif
            <span class="mailbox-attachment-size clearfix mt-1">
                          {{$size}}
                @if($download_url)
                    <a href="{{$download_url}}" class="btn btn-default btn-xs float-right" download target="_blank">
                            <i class="fas fa-cloud-download-alt"></i>
                          </a>
                @endif
                        </span>
        </div>
    </li>
</ul>
