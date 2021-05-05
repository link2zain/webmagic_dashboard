<div class="card @isset($class){!!$class!!}@endisset box-solid">
    <div class="card-header @isset($borderClass){!!$borderClass!!}@endisset">
        @isset($iconLeft) <i class="{{$iconLeft}} margin-r-5"></i> @endisset
        <h3 class="card-title">{!!$title!!}</h3>
        <div class="card-tools ">
            <button type="button" class="btn btn-box-tool @isset($btnClass){!!$btnClass!!}@endisset" data-card-widget="remove"><i class="fas fa-times"></i></button>
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.box-header -->
    @isset($content) <div class="card-body">{!!$content!!}</div> @endisset
    <!-- /.box-body -->
</div>
