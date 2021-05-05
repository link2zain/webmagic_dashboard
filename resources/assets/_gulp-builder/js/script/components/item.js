//todo test this class, changed from old syntax

import { modals } from './modals.js'
import { controls } from './controls.js'
import { alerts } from './alerts'
/**
 * Simple action for creating
 * @type {{create_item_btns_init: Function, add_item: Function}}
 */

export let item = {
    create() {
        location.reload();
    },
    delete(item_tag) {
       $(item_tag).fadeOut(200);

      setTimeout(function() {
        $(item_tag).remove();
      }, 200)
    },
    create_btn_init(btn) {
        app.bodyEl.on('click', btn, function(e) {
            e.preventDefault();

            let action = $(this).data('action');

            let show_modal = function(content) {
                modals.withFrom(item.create, content);
            };

            controls.ajax_action(action, 'GET', show_modal);
        })
    },
    delete_btn_init(btn) {

       app.bodyEl.on('click', btn, function(event) {
            event.preventDefault();
            let action = $(this).data('request');
            let removing_item_tag = $(this).data('item');
            let method = $(this).data('method');

            method = typeof method !== 'undefined' ? method : 'POST';

            let remove_item = function() {
                console.log('remove_item');
                item.delete(removing_item_tag);
            };

            let show_error = function(data) {

              if(data === undefined || !data.responseText){
                alerts.error();
                return;
              }
              alerts.error(data.responseText);
            };

            let action_function = function() {
                controls.ajax_action(action, method, remove_item, show_error);
            };

           let modalConfirmTtl = $(this).data('delete-modal-ttl') ?? app.translate.modalConfirmTtl;
           let modalConfirmCnt = $(this).data('delete-modal-cnt') ?? app.translate.modalConfirmCnt;

            modals.base(action_function,
                modalConfirmTtl,
                modalConfirmCnt,
                app.translate.modalConfirmBtnTxt,
                app.translate.modalConfirmBtnCancelTxt);
        })
    }
};
