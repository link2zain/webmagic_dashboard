<a href="https://wm-dev.atlassian.net/wiki/spaces/LAR/pages/3019850?preview=/3019850/6357041/graphics.jpg">See screen</a>

<section class="content">
    <div class="row">
        <div class="col-md-6 js_graphic-parent">
            <!-- AREA CHART -->
            <div class="card box-primary">
                <div class="card-header with-border">
                    <h3 class="card-title">Tittle Graphics</h3>

                    <div class="card-tools pull-right">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas class="js_graphic-default" width="500px" height="200" style="width: 500px; height: 200px;" data-url="/"></canvas>
                        <a href="#" class="text-light-blue pull-right js_graphic-change" style="padding: 3px 0;">Change of view</a>
                    </div>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="card no-border">
                        <div class="callout js_graphic-description">
                            <h4>USD</h4>
                            <b>27.15</b>
                            <p class="direct-chat-info direct-chat-timestamp">Lorem ipsum dolor</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card no-border">
                        <div class="callout js_graphic-description">
                            <h4>USD</h4>
                            <b>27.15</b>
                            <p class="direct-chat-info direct-chat-timestamp">Lorem ipsum dolor</p>
                        </div>
                    </div>
                </div>

            </div>



        </div>
        <div class="col-md-6 js_graphic-parent">
            <!-- AREA CHART -->
            <div class="card box-primary">
                <div class="card-header with-border">
                    <h3 class="card-title">Tittle Graphics</h3>

                    <div class="card-tools pull-right">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas class="js_graphic-without-point-grid" width="500px" height="200" style="width: 500px; height: 200px;" data-url="/"></canvas>
                        <a href="#" class="text-light-blue pull-right js_graphic-change" style="padding: 3px 0;">Change of view</a>
                    </div>
                    <form class="form-group margin js_graphic-form" action="/rout" method="POST" >

                        <label>Date range:</label>
                        <div class="row">
                            <div class="col-lg-4 col-sm-6">
                                From:
                                <div class="input-group">
                                    <div class="input-group-addon datepicker">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                    <input class="form-control js_date_range_picker" data-format="d/m/Y" data-time="false" name="fromDate" data-value="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                To:
                                <div class="input-group">
                                    <div class="input-group-addon datepicker">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                    <input class="form-control js_date_range_picker-end" data-format="d/m/Y"  data-time="false" name="toDate" data-value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group  ">
                                    <label>Category</label>
                                    <select class="form-control js-select2 " multiple data-placeholder="Select a Category" style="width: 100%;" tabindex="-1" aria-hidden="true" name="category" data-value="">
                                        <option>Alabama</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <!-- /.input group -->
                    </form>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

        <div class="col-md-6 js_graphic-parent">
            <!-- AREA CHART -->
            <div class="card box-primary">
                <div class="card-header with-border">
                    <h3 class="card-title">Tittle Graphics</h3>

                    <div class="card-tools pull-right">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas class="js_graphic-bar" width="500px" height="200" style="width: 500px; height: 200px;" data-url="/"></canvas>
                        <a href="#" class="text-light-blue pull-right js_graphic-change" style="padding: 3px 0;">Change of view</a>

                    </div>
                </div>
                <form class="form-group margin js_graphic-form-bar" action="/rout" method="POST" >

                    <label>Date range:</label>
                    <div class="row">
                        <div class="col-lg-4 col-sm-6">
                            From:
                            <div class="input-group">
                                <div class="input-group-addon datepicker">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                <input class="form-control js_date_range_picker" data-format="d/m/Y" data-time="false" name="fromDate" data-value="">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            To:
                            <div class="input-group">
                                <div class="input-group-addon datepicker">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                <input class="form-control js_date_range_picker-end" data-format="d/m/Y"  data-time="false" name="toDate" data-value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group  ">
                                <label>Category</label>
                                <select class="form-control js-select2 " multiple data-placeholder="Select a Category" style="width: 100%;" tabindex="-1" aria-hidden="true" name="category" data-value="">
                                    <option>Alabama</option>
                                    <option>Alaska</option>
                                    <option>California</option>
                                    <option>Delaware</option>
                                    <option>Tennessee</option>
                                    <option>Texas</option>
                                    <option>Washington</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <!-- /.input group -->
                </form>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-md-6 js_graphic-parent">
            <!-- AREA CHART -->
            <div class="card box-primary">
                <div class="card-header with-border">
                    <h3 class="card-title">Tittle Graphics</h3>

                    <div class="card-tools pull-right">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas class="js_graphic-default2" width="500px" height="200" style="width: 500px; height: 200px;" data-url="/"></canvas>
                            <a href="#" class="text-light-blue pull-right js_graphic-change" style="padding: 3px 0;">Change of view</a>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
    </div>

</section>
