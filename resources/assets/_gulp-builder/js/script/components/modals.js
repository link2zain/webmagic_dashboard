/**
 * Use for modals control, Realized few type of modals
 *
 * @type {{base: Function, withFrom: Function, set_content: Function}}
 */
export let modals = {
    /**
     * Open modal for action that need confirmation
     *
     * @param confirm_function - function which would be call after confirm
     * @param title
     * @param content
     * @param btn_name
     * @param btn_cancel_name
     */
    base(confirm_function, title, content, btn_name, btn_cancel_name = '') {
        let modal_blk = $('.js_base_modal');

        this.set_content(modal_blk, title, content, btn_name, btn_cancel_name);

        $(modal_blk).on('click', '.js_confirm_btn', function() {
            $(modal_blk).modal('hide');
            confirm_function();
            $(modal_blk).off('click', '.js_confirm_btn');
        });

        $(modal_blk).modal();
    },

    /**
     * Open modal with form
     *
     * @param confirm_function
     * @param content
     */
    withFrom(confirm_function, content) {
        let modal_blk = $('.js_empty_modal');
        $(modal_blk).html(content);
        //ui.date_picker_init();

        let success_function = function(data) {
            confirm_function(data);
            $(modal_blk).modal('hide');
        };

        let error_function = function(errors) {
            errors = $.parseJSON(errors);
            let errors_string = '';
            $.map(errors, function(val, name) {
                errors_string += `${name}:${val}<br>`;
                $(modal_blk).find('.status').html(
                    `<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">?</button>
                        <h4><i class="icon fas fa-ban"></i> �������� ������</h4>
                        ${errors_string}
                     </div>`);
            });
        };

        let action = $(modal_blk).find('form').attr('action');
        let method = $(modal_blk).find('form').attr('method');

        $(modal_blk).on('submit', 'form', function(event) {
            event.preventDefault();
            let data = $(this).serialize();
            controls.ajax_action(action, method, success_function, error_function, data);
        });

        $(modal_blk).on('hidden.bs.modal', function() {
            $(modal_blk).off('submit', 'form');
        });

        $(modal_blk).modal();
    },


    /**
     * Set modal content
     *
     * @param modal_blk
     * @param title
     * @param content
     * @param btn_name
     * @param btn_cancel_name
     */
    set_content(modal_blk, title, content, btn_name, btn_cancel_name) {
        $(modal_blk).find('.modal-title').html(title);
        $(modal_blk).find('.modal-body').find('p').html(content);
        $(modal_blk).find('.js_confirm_btn').html(btn_name);
        if(btn_cancel_name !== '' ){

            $(modal_blk).find('.js_confirm_btn_cancel').html(btn_cancel_name);
        }
    }

};