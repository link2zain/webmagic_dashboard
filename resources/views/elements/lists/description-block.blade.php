<ul class="list-group list-group-unbordered ">
    @foreach($data as $title => $value)
        <li class="list-group-item clearfix">
            <div class="col-lg-2 col-md-3">
                <b>{!! $title !!}</b>
            </div>
            <div class="col-lg-10 col-md-9">
                {!! $value !!}
            </div>
        </li>
    @endforeach
</ul>