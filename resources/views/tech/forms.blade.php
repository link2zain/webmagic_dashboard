<a href="https://wm-dev.atlassian.net/wiki/spaces/LAR/pages/3019850?preview=/3019850/6389773/forms.jpg">See screen</a>

<div class="box">
    <div class="card-header with-border">
        <h3 class="card-title">Forms</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form class="js-submit " action="" method="post">
        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
        <div class="card-body">
            {{--form group with input--}}
            @include('dashboard::elements.forms.elements.form_group', [
                'form_class' => 'margin',
                'label_id' => 'input1',
                'label_txt' => 'Название *',
                'field_view' => 'dashboard::elements.forms.elements.input',
                'field_options'=> [
                     'class' => 'form-control',
                     'id' => 'input1',
                     'type' => 'text'
                ]
            ])
            {{--form group with input end--}}

            {{--form group with select--}}
            @include('dashboard::elements.forms.elements.form_group', [
                'form_class' => 'margin',
                'label_txt' => 'Родительская категория',
                'field_view' => 'dashboard::elements.forms.elements.select',
                'field_options'=> [
                     'class' => 'js_ui-base-select',
                     'name' => 'select1',
                     'options' => [
                        'alabama' => 'Alabama',
                        'alaska' => 'Alaska',
                        'california' => 'California',
                        'texas' => 'Texas',
                        'washington' => 'Washington'
                    ]
                ]
            ])
            {{--form group with select end--}}


            {{--form group with input group--}}
            @include('dashboard::elements.forms.elements.form_group', [
               'form_class' => 'margin',
               'label_id' => 'input2',
               'label_txt' => 'Ссылка *',
               'field_view' => 'dashboard::elements.forms.elements.input_group',
               'field_options'=> [
                    'group_class' => 'input-group-btn',
                    'group_addon_class' => 'btn btn-primary disabled',
                    'group_addon_txt' => 'http://electro-project.com.ua/category1/',
                    'field_view' => 'dashboard::elements.forms.elements.input',
                    'field_options'=> [
                         'class' => 'form-control',
                         'id' => 'input2',
                         'type' => 'email'
                        ]
               ]
            ])
            {{--form group with input group end--}}


            {{--input type file--}}
            @include('dashboard::elements.forms.elements.form_group', [
               'form_class' => 'margin',
               'label_id' => 'exampleInputFile',
               'label_txt' => 'File input',
               'field_view' => 'dashboard::elements.forms.elements.input',
               'field_options'=> [
                    'id' => 'exampleInputFile',
                    'type' => 'file'
               ]
           ])
            {{--input type file end--}}


            {{--default checkbox--}}
            @include('dashboard::elements.forms.elements.form_group', [
              'form_class' => 'margin',
              'wrap_field' => 'checkbox',
              'field_view' => 'dashboard::elements.forms.elements.checkbox',
              'field_options'=> [
                    'text' => 'default checkbox',
                     'name' => 'checkboxDefault',
                     'value' => 'checkboxDefault',
              ]
            ])
            {{--default checkbox end--}}

            {{--form group with multiple select--}}
            @include('dashboard::elements.forms.elements.form_group', [
              'form_class' => 'margin',
              '$label_txt' => 'Multiple',
              'field_view' => 'dashboard::elements.forms.elements.select',
              'field_options'=> [
                    'class' => 'form-control js-select2 js_ui-selected-all',
                     'name' => 'select2',
                     'multiple'=> true,
                     'placeholder' => 'Select a State',
                     'options' => [
                        'alabama' => 'Alabama',
                        'alaska' => 'Alaska',
                        'california' => 'California',
                        'texas' => 'Texas',
                        'washington' => 'Washington'
                    ],
              ]
            ])
            {{--form group with multiple multiple select end--}}


            {{--checkboxes--}}
            <div class="margin">
                @include('dashboard::elements.forms.elements.checkbox', [
                     'class' => 'js_ui-checkbox-selected-all',
                     'style' => 'font-weight: normal;',
                     'select' => '.js_ui-selected-all',
                     'text' => 'Все категории',
                     'icheck'=>'blue'
                   ])
            </div>
            <div class="margin">
                @include('dashboard::elements.forms.elements.checkbox', [
                     'name' => 'checkbox1',
                     'value' => 'checkbox1',
                     'style' => 'font-weight: normal;',
                     'checked' => true,
                     'required' => true,
                     'text' => 'checkbox type 1',
                     'icheck'=>''
                   ])
                <br>
                @include('dashboard::elements.forms.elements.checkbox', [
                     'name' => 'checkbox2',
                     'value' => 'checkbox2',
                     'text' => 'checkbox type 2',
                     'icheck'=>'red'
                   ])
                <br>
                @include('dashboard::elements.forms.elements.checkbox', [
                     'type' => 'radio',
                     'name' => 'radio1',
                     'value' => '1',
                     'checked' => true,
                     'text' => 'radio type 1',
                     'icheck'=>''
                   ])
                <br>
                @include('dashboard::elements.forms.elements.checkbox', [
                     'type' => 'radio',
                     'name' => 'radio1',
                     'value' => '2',
                     'text' => 'radio type 2',
                     'icheck'=>'blue'
                   ])
                <br>
                @include('dashboard::elements.forms.elements.checkbox', [
                     'type' => 'radio',
                     'name' => 'radio1',
                     'value' => '3',
                     'text' => 'radio type 3',
                     'icheck'=>'red'
                   ])
                <br>
                <div>
                    @include('dashboard::elements.forms.elements.switch', [
                      'name' => 'name',
                      'value' => 'name',
                      'text' => 'switch',
                      'checked' => false,
                      'color' => '#3c8dbc'
                    ])
                </div>


            </div>
            {{--checkboxes end--}}


            <div class="margin ckeditor">
                <textarea name="" id="ckEditor" cols="30" rows="10"></textarea>
            </div>
            <div class="form-group margin">
                <label>Date range:</label>
                <div class="row">
                    <div class="col-md-3">
                        From:
                        @include('dashboard::elements.forms.elements.input_group', [
                             'group_class' => 'input-group-addon datepicker',
                             'icon_addon' => 'fas fa-calendar',
                             'field_view' => 'dashboard::elements.forms.elements.input',
                             'field_options' => [
                                'class' => 'form-control js_date_range_picker',
                               'id' => 'exampleInputFile',
                               'data' => 'data-format="d/m/Y" data-time="false"'
                             ]
                          ])

                    </div>
                    <div class="col-md-3">
                        To:
                        @include('dashboard::elements.forms.elements.input_group', [
                             'group_class' => 'input-group-addon datepicker',
                             'icon_addon' => 'fas fa-calendar',
                             'field_view' => 'dashboard::elements.forms.elements.input',
                             'field_options' => [
                               'class' => 'form-control js_date_range_picker-end',
                               'id' => 'exampleInputFile',
                               'data' => 'data-format="d/m/Y" data-time="false"'
                             ]
                          ])
                    </div>
                </div>

                <!-- /.input group -->
            </div>

        </div>
        <!-- /.box-body -->
        <div class="card-footer">
            {{--<button type="submit" class="btn btn-info pull-right">Submit</button>--}}
            @include('dashboard::elements.buttons.button', [
                'type' => 'submit',
                'class' => 'btn-info float-right',
                'content' => 'Submit'
            ])
        </div>
        <!-- /.box-footer -->
    </form>
    <!-- form end -->
</div>
