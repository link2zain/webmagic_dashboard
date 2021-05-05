<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
    Вызвать попап
</button>

{{--todo: delete tag style and inline styles for #modal-default when copy the layout--}}

<style>
    .modal-backdrop.fade.in{
        z-index: 1;
    }
</style>

<div class="modal fade" id="modal-default" style="top: 40px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card box-info">
                <div class="modal-header">
                    <h4 class="modal-title">Default Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <form class="js-submit" action="#" method="post" data-original-title="" title="">
                    <div class="modal-body">
                        <div class="form-group margin " data-original-title="" title="">
                            <label for="input1" data-original-title="" title="">Название *</label>
                            <input type="text" class="form-control" id="input1" data-original-title="" title="" placeholder="Название 1">
                        </div>
                        <div class="form-group margin">
                            <label>Название *</label>
                            <select class="form-control select2 select2-hidden-accessible js_ui-base-select" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option selected="selected">Alabama</option>
                                <option>Alaska</option>
                                <option>California</option>
                                <option>Delaware</option>
                                <option>Tennessee</option>
                                <option>Texas</option>
                                <option>Washington</option>
                            </select>
                        </div>
                        <div class="form-group  margin">
                            <label>Multiple</label>
                            <select class="form-control js-select2 js_ui-selected-all" multiple data-placeholder="Select a State" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option>Alabama</option>
                                <option>Alaska</option>
                                <option>California</option>
                                <option>Delaware</option>
                                <option>Tennessee</option>
                                <option>Texas</option>
                                <option>Washington</option>
                            </select>
                        </div>
                        <div class="form-group margin">
                            <label>Название *</label>
                            <div class="input-group">
                                <div class="input-group-addon datepicker">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control float-right js_date_range_picker" id="reservation">
                            </div>
                            <!-- /.input group -->
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-block btn-info btn-flat">Добавить</button>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-block btn-warning btn-flat">Изменить</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>

