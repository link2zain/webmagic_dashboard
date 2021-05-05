{{--<a href="https://wm-dev.atlassian.net/wiki/spaces/LAR/pages/3019850?preview=/3019850/7274502/buttons.jpg">See screen</a>--}}
<div class="col-lg-2">
   {{-- @php
        $button = app()->make(\Webmagic\Dashboard\Elements\Buttons\Button::class);

        $presenter = new \Webmagic\Dashboard\Docs\Presenter();
        $objects = $presenter->showDocs($button);
    @endphp

   @foreach($objects as $object)
       <p>
       {!! $object !!}
       </p>
   @endforeach
--}}

    <p> /elements/buttons/button</p>
    {{--Webmagic\Dashboard\Elements\Buttons--}}
    <div class="card-body">
        @include('dashboard::elements.buttons.button', [
            'class' => 'btn-primary',
            'content' => 'Внести изменения'
        ])
    </div>
    <div class="card-body">
        @include('dashboard::elements.buttons.button', [
            'class' => 'bg-teal btn-sm',
            'content' => 'Новый товар',
            'icon' => 'fas fa-plus'
        ])
    </div>
    <div class="card-body">
        @include('dashboard::elements.buttons.button', [
            'class' => 'btn-sm bg-teal',
            'content' => 'Копировать',
            'icon' => 'fas fa-copy'
        ])
    </div>

    <p> /elements/buttons/button_group</p>
    {{--Webmagic\Dashboard\Elements\Buttons\ButtonGroup--}}
    <div class="card-body">
        @include('dashboard::elements.buttons.button_group.button_group', [
            'class' => '',
            'button_class' => 'bg-teal',
            'content' => 'Просмотреть',
            'icon' => 'fas fa-eye',
            'items' => [
                [
                    'link' => '#',
                    'content' => 'Action'
                ],
                [
                    'link' => '#',
                    'content' => 'Another action'
                ],
                [
                    'link' => '#',
                    'content' => 'Something else here'
                ],
                [
                    'divider' => true
                ],
                [
                    'link' => '#',
                    'content' => 'Separated link'
                ],

            ]
        ])
    </div>
    <div class="card-body">
        @include('dashboard::elements.buttons.button_group.button_group', [
            'class' => 'float-right',
            'button_class' => 'bg-teal',
            'content' => 'Просмотреть',
            'icon' => 'fas fa-eye',
            'items' => [
                [
                    'link' => '#',
                    'content' => 'Action'
                ],
                [
                    'link' => '#',
                    'content' => 'Another action'
                ],
                [
                    'link' => '#',
                    'content' => 'Something else here'
                ],
                [
                    'divider' => true
                ],
                [
                    'link' => '#',
                    'content' => 'Separated link'
                ],

            ]
        ])
    </div>
</div>

<div class="col-lg-2">
    <p> /elements/buttons/button_link</p>
    {{--Webmagic\Dashboard\Elements\Buttons\ButtonLink--}}
    <div class="card-body">
        @include('dashboard::elements.buttons.button_link', [
            'class' => 'text-light-blue',
            'iconFirst' => 'fas fa-plus',
            'content' => 'Comment'
        ])
    </div>
    <div class="card-body">
        @include('dashboard::elements.buttons.button_link', [
            'class' => 'text-light-blue margin-r-5',
            'iconFirst' => 'fas fa-plus',
            'content' => 'Name ',
            'iconLast' => 'fas fa-stop text-green js-color-pick colorpicker-element'
        ])
    </div>
    <div class="card-body">
        @include('dashboard::elements.buttons.button_link', [
            'class' => 'text-light-blue ',
            'iconFirst' => 'fas fa-check ',
            'content' => 'Done'
        ])
    </div>
    <div class="card-body">
        @include('dashboard::elements.buttons.button_link', [
            'class' => 'text-red',
            'iconFirst' => 'fas fa-close ',
            'content' => 'Delete'
        ])
    </div>
    <div class="card-body">
        @include('dashboard::elements.buttons.button_link', [
            'class' => 'text-green',
            'iconFirst' => 'fas fa-check',
            'content' => 'Создать',
        ])
    </div>
    <div class="card-body">
        @include('dashboard::elements.buttons.button_link', [
            'class' => 'text-light-blue',
            'iconFirst' => 'fas fa-pencil',
            'content' => 'Edit'
        ])
    </div>
    <div class="card-body">
        @include('dashboard::elements.buttons.button_link', [
            'class' => 'text-purple',
            'iconFirst' => 'fas fa-eye',
            'content' => 'View'
        ])
    </div>
    <div class="card-body">
        @include('dashboard::elements.buttons.button_link', [
            'class' => 'text-green',
            'iconFirst' => 'fas fa-plus',
            'content' => 'Добавить новую страницу'
        ])
    </div>
    <div class="card-body">
        @include('dashboard::elements.buttons.button_link', [
            'class' => 'text-light-blue',
            'iconFirst' => 'fas fa-sort',
            'content' => 'Изменить поля'
        ])
    </div>
    <div class="card-body">
        @include('dashboard::elements.buttons.button_link', [
            'class' => 'text-light-blue',
            'content' => 'Change of view'
        ])
    </div>
    {{--</div>--}}
    {{--<div class="card-body">--}}
        {{--<a href="#" class="text-light-blue margin-r-5">--}}
            {{--<i class="fas fas fa-plus"></i>--}}
            {{--Name--}}
            {{--<i class="fas fa-stop text-green js-color-pick"></i>--}}
        {{--</a>--}}
    {{--</div>--}}
    {{--<div class="card-body">--}}
        {{--<a href="#" class="text-light-blue">--}}
            {{--<i class="fas fa-check margin-r-5"></i>--}}
            {{--Done--}}
        {{--</a>--}}
    {{--</div>--}}
    {{--<div class="card-body">--}}
        {{--<a href="#" class="text-red">--}}
            {{--<i class="fas fa-close margin-r-5"></i>--}}
            {{--Delete--}}
        {{--</a>--}}
    {{--</div>--}}
    {{--<div class="card-body">--}}
        {{--<a href="#" class="text-green">--}}
            {{--<i class="fas fa-check margin-r-5"></i>--}}
            {{--Создать--}}
        {{--</a>--}}
    {{--</div>--}}
    {{--<div class="card-body">--}}
        {{--<a href="#" class="text-red">--}}
            {{--<i class="fas fa-close margin-r-5"></i>--}}
            {{--Отменить--}}
        {{--</a>--}}
    {{--</div>--}}
    {{--<div class="card-body">--}}
        {{--<a href="#" class="text-light-blue">--}}
            {{--<i class="fas fa-pencil margin-r-5"></i>--}}
            {{--Edit--}}
        {{--</a>--}}
    {{--</div>--}}
    {{--<div class="card-body">--}}
        {{--<a href="#" class="text-purple">--}}
            {{--<i class="fas fa-eye margin-r-5"></i>--}}
            {{--View--}}
        {{--</a>--}}
    {{--</div>--}}
    {{--<div class="card-body">--}}
        {{--<a href="#" class="text-light-blue">--}}
            {{--<i class="fas fa-plus margin-r-5"></i>--}}
            {{--Добавить файл--}}
        {{--</a>--}}
    {{--</div>--}}
    {{--<div class="card-body">--}}
        {{--<a href="#" class="text-green">--}}
            {{--<i class="fas fa-plus margin-r-5"></i>--}}
            {{--Добавить новую страницу--}}
        {{--</a>--}}
    {{--</div>--}}
    {{--<div class="card-body">--}}
        {{--<a href="#" class="text-light-blue">--}}
            {{--<i class="fas fa-sort margin-r-5"></i>--}}
            {{--Изменить поля--}}
        {{--</a>--}}
    {{--</div>--}}
    {{--<div class="card-body">--}}
        {{--<a href="#" class="text-light-blue">--}}
            {{--Change of view--}}
        {{--</a>--}}
    {{--</div>--}}
</div>

<div class="col-lg-2">
    <p> /elements/buttons/button_link</p>
    {{--Webmagic\Dashboard\Elements\Buttons\ButtonLink--}}
    <p> without content </p>
    <div class="card-body">
        @include('dashboard::elements.buttons.button_link', [
               'class' => 'text-green',
               'iconFirst' => 'fas fa-file'
           ])
    </div>
    <div class="card-body">
        @include('dashboard::elements.buttons.button_link', [
           'class' => 'text-blue',
           'iconFirst' => 'fas fa-pencil'
       ])
    </div>
    <div class="card-body">
        @include('dashboard::elements.buttons.button_link', [
           'class' => 'link-black',
           'iconFirst' => 'fas fa-cog'
       ])
    </div>
    <p> Size </p>
    <div class="card-body">
        @include('dashboard::elements.buttons.button_link', [
           'class' => 'text-red btn-lg',
           'iconFirst' => 'fas fa-close'
       ])
    </div>
    <div class="card-body">
        @include('dashboard::elements.buttons.button_link', [
           'class' => 'text-red',
           'iconFirst' => 'fas fa-close'
       ])
    </div>
    <div class="card-body">
        @include('dashboard::elements.buttons.button_link', [
           'class' => 'text-red btn-sm',
           'iconFirst' => 'fas fa-close'
       ])
    </div>


   {{-- <div class="card-body">
        <a href="#" class="link-black"><i class="fas fa-file text-green"></i></a>
    </div>
    <div class="card-body">
        <a href="#" class="link-black"><i class="fas fa-pencil text-blue"></i></a>
    </div>
    <div class="card-body">
        <a href="#" class="link-black"><i class="fas fa-cog"></i></a>
    </div>
    <div class="card-body">
        <a href="#" class="link-black"><i class="fas fa-close text-red"></i></a>
    </div>--}}
</div>

<div class="col-lg-2">
    <p>/elements/form/elements/switch</p>
    {{--Webmagic\Dashboard\Elements\Buttons\ButtonSwitch--}}
    <div class="card-body">
        @include('dashboard::elements.forms.elements.switch', [
         'name' => 'name',
          'value' => 'name'
        ])
    </div>
    <div class="card-body">
        @include('dashboard::elements.forms.elements.switch', [
          'name' => 'name1',
          'value' => 'name1',
          'text' => 'Не активна'
         ])
    </div>
    <div class="card-body">
        @include('dashboard::elements.forms.elements.switch', [
          'name' => 'name2',
          'value' => 'name2',
          'checked' => true,
          'text' => 'Активна',
          'color' => 'red',
          'size' => 'default'
         ])
    </div>
    <div class="card-body">
        @include('dashboard::elements.forms.elements.switch', [
          'name' => 'name3',
          'value' => 'name3',
          'checked' => true,
          'text' => 'Активна',
          'color' => '#3c8dbc',
          'size' => 'large'
         ])
    </div>

    <div class="card-body">
        @include('dashboard::elements.forms.elements.switch', [
          'name' => 'name4',
          'value' => 'name4',
          'size' => 'small'
         ])
    </div>

</div>

