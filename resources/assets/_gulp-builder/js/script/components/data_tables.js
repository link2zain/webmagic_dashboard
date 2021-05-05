
import '../../../node_modules/datatables/media/js/jquery.dataTables'

//Data tables functionality

export let dataTables = {

    init(item) {

        //language settings
        let settingsLang = {
            ru: {
                "language": {
                    "lengthMenu": "Показывать по _MENU_",
                    "zeroRecords": "Пока ничего нет",
                    "info": "Показано _PAGE_ из _PAGES_",
                    "infoEmpty": "Ничего не найдено",
                    "infoFiltered": "(filtered from _MAX_ total records)",
                    "search": "Поиск",
                    paginate: {
                        first: "Первая",
                        previous: "Предыдущая",
                        next: "Следующая",
                        last: "Последняя"
                    }
                }
            },
            en: {
                "sInfo": "Showing _START_ to _END_ of _TOTAL_ entries"
            }
        };

        let setting = {
            //function for redrawing table with plugins reinitialization
            // 'drawCallback': function() {
            //     $('input[type="checkbox"][data-icheck]').iCheck({
            //         checkboxClass: 'icheckbox_minimal-blue'
            //     });
            //      // ui.switchery($('.js-switch'));
            // },
            //checkboxes settings
            'columnDefs': [
                {
                    'targets': 0,//what column will has checkboxes
                    'checkboxes': {
                        'selectRow': true,
                    }
                }
            ]
        };

        let initSettings = settingsLang[app.locale];
        let dataTable = $(item).DataTable(Object.assign({}, setting , initSettings ));

        //Handle iCheck change event for "select all" control
        // $(item).on('ifChanged', '.dt-checkboxes-select-all input[type="checkbox"]', function(){
        //
        //     let tableCheckboxes = $(item).find('tbody .icheckbox_minimal-blue');
        //     let col = dataTable.column($(this).closest('th'));
        //
        //     //checking all checkboxes when check checkbox Select All (!! don't need if we don't use the iCheck plugin !!)
        //     if(this.checked){
        //         $(tableCheckboxes).addClass('checked');
        //     }else{
        //         $(tableCheckboxes).removeClass('checked');
        //     }
        //     col.checkboxes.select(this.checked);
        // });

        //Handle iCheck change event for checkboxes in table body
        // $(item).on('ifChanged', '.dt-checkboxes-cell input[type="checkbox"]', function(){
        //     let cell = dataTable.cell($(this).closest('td'));
        //     cell.checkboxes.select(this.checked);
        // });

        // deleting a row
        $('body').on('click', '.js_deleteRowBtn', function(event) {
            event.preventDefault();
            $(this).closest('tr').remove();
        })

    }
};

