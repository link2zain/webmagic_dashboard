{{--<a href="https://wm-dev.atlassian.net/wiki/spaces/LAR/pages/3019850?preview=/3019850/7995405/notifications.jpg">See screen</a>--}}


<div class="col-lg-2">
    <p>/elements/notifications/notification</p>
    <p>Without box-body</p>
    @include('dashboard::elements.notifications.notification', [
            'class' => 'bg-green',
            'iconLeft' => 'fas fa-check',
            'title' => 'Импорт выполнен',
            'btnClass' => 'bg-green'
        ])
</div>

<div class="col-lg-3">
    <p>/elements/notifications/notification</p>
    <p>With box-body</p>
    @include('dashboard::elements.notifications.notification', [
            'class' => 'box-success',
            'borderClass' => 'with-border',
            'iconLeft' => 'fas fa-check',
            'title' => 'Импорт выполнен',
            'content' => 'Файл 1122.jpg. был успешно импортирован'
        ])
</div>

<div class="col-lg-2">
    <p>/elements/notifications/notification</p>
    <p>Without box-body</p>
    @include('dashboard::elements.notifications.notification', [
            'class' => 'bg-red',
            'iconLeft' => 'fas fa-ban',
            'title' => 'Ошибка импорта',
            'btnClass' => 'bg-red'
        ])
</div>

<div class="col-lg-3">
    <p>/elements/notifications/notification</p>
    <p>With box-body</p>
    @include('dashboard::elements.notifications.notification', [
            'class' => 'box-danger',
            'borderClass' => 'with-border',
            'iconLeft' => 'fas fa-ban',
            'title' => 'Ошибка импорта',
            'content' => 'Не удалось импортировать 1122.jpg. Попробуйте использовать файлы формата .docx, .xlsx и повторите попытку.'
        ])
</div>


{{--
<div class="col-lg-2">
    <div class="card bg-green box-solid ">
        <div class="card-header">
            <i class="fas fa-check margin-r-5"></i>
            <h3 class="card-title">Импорт выполнен</h3>
            <div class="card-tools pull-right ">
                <button type="button" class="btn btn-box-tool bg-green" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.box-header -->
    </div>
</div>

<div class="col-lg-3">
    <div class="card box-success box-solid">
        <div class="card-header with-border">
            <i class="fas fa-check margin-r-5"></i>
            <h3 class="card-title">Импорт выполнен</h3>
            <div class="card-tools pull-right">
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.box-header -->
        <div class="card-body">
            Файл 1122.jpg. был успешно
            импортирован
        </div>
        <!-- /.box-body -->
    </div>
</div>

<div class="col-lg-2">
    <div class="card bg-red box-solid ">
        <div class="card-header">
            <i class="fas fa-ban margin-r-5"></i>
            <h3 class="card-title">Ошибка импорта</h3>
            <div class="card-tools pull-right ">
                <button type="button" class="btn btn-box-tool bg-red" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.box-header -->
    </div>
</div>

<div class="col-lg-3">
    <div class="card box-danger box-solid">
        <div class="card-header with-border">
            <i class="fas fa-ban margin-r-5"></i>
            <h3 class="card-title">Ошибка импорта</h3>
            <div class="card-tools pull-right">
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.box-header -->
        <div class="card-body">
            Не удалось импортировать 1122.jpg.
            Попробуйте использовать файлы
            формата .docx, .xlsx и повторите
            попытку.
        </div>
        <!-- /.box-body -->
    </div>
</div>--}}
