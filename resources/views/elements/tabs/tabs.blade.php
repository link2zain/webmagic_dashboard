<section class="content" {!! $dynamic_fields !!}>
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" role="tablist">
                        {!! $navigation !!}
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        @foreach($tabs as $tab)
                            {!! $tab !!}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



