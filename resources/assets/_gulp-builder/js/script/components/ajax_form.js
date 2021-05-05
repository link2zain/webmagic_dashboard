/**
 *  Use for send form data with ajax
 *
 *  Possible to send 1 or more files
 *  For all files attribute name will be added ordinal number
 *
 * @type {{submit_init: Function}}
 */

import { alerts } from './alerts.js';
import { Sendform } from "../../libs/sendform/sendform2";
import { Updating } from "./updating";

export class AjaxForm {
    constructor(form){
        this.form = form;
        this.modalHide = true;
    }

    successSubmit(data, resultBlock, replaceBlk, msgSuccess) {
        if(msgSuccess){
            alerts.success('', app.translate.success);
        }
        $('.form-group').removeClass('has-error');
        $('.help-block').html('');
        this.insertResult(data, resultBlock, replaceBlk);
    }


    errorSubmit(data, msgError) {
        $('.form-group').removeClass('has-error');
        $('.help-block').html('');

        let error_msg = [];

        if(!msgError) return; //not show messages

        if(data === undefined || ( !data && !data.errors)){
            alerts.error(app.translate.error);
            return;
        }


        $.each(data.errors, (el) => {
          let errMsg = data.errors[el];
          error_msg.push(`${errMsg} </br>`);
          this.validation_input(el,errMsg);
        });

        alerts.error(data.message, error_msg);

    }

    init(formClass = this.form){
        let _this= this;
        $(formClass).each(function( index ) {
            let $thisForm = $( this );

            let method = $thisForm.attr('method') === undefined ? "POST" : $thisForm.attr('method');
            let actionEl = $thisForm.data('action-from-child') === undefined ? '' : $thisForm.data('action-from-child');
            let resultBlock = $thisForm.data('result') === undefined ? '' : $thisForm.data('result');
            let replaceBlock = $thisForm.data('replace-blk') === undefined ? '' : $thisForm.data('replace-blk');
            let sendAllCheckbox = $thisForm.data('send-all-checkbox') === undefined ? false : $thisForm.data('send-all-checkbox');
            let msgSuccess = $thisForm.data('success-msg') === undefined ? true : $thisForm.data('success-msg');
            let msgError = $thisForm.data('error-msg') === undefined ? true : $thisForm.data('error-msg');

            console.log(sendAllCheckbox);

            let sendForm =  new Sendform($thisForm[0], {
                method: method,
                actionEl: actionEl,
                sendAllCheckbox:sendAllCheckbox,
                success: (data) => {
                    if($(_this.form).closest('.js_base_modal_empty').length && _this.modalHide){
                        let $modalWithForm = $('.js_base_modal_empty');
                        resultBlock = $modalWithForm.attr('data-result-blk') === undefined ? '' : $modalWithForm.attr('data-result-blk');
                        replaceBlock = $modalWithForm.attr('data-replace-blk') === undefined ? '' : $modalWithForm.attr('data-replace-blk');
                        $modalWithForm.modal('hide');
                    }
                    _this.successSubmit(data.response, resultBlock, replaceBlock, msgSuccess);
                    sendForm.removeStatusText();
                },
                error:  (data) => {
                    _this.errorSubmit(JSON.parse(data.response), msgError);
                    sendForm.removeStatusText();
                }
            });
            // hide modal after submit form
            app.bodyEl.on('click', formClass +' [type=submit]', function (e) {
                if($(this).attr('data-modal-hide') == false || $(this).attr('data-modal-hide') == 'false'){
                    _this.modalHide = false;
                }else{
                    _this.modalHide = true;
                }
            })
        });
    }

    validation_input(el, txt = ''){
        let $input = $(`[name=${el}]`);
        if($input.is(':visible') && $input.attr('type') !== 'file'){
          $input.closest('.form-group').addClass('has-error');
          $input.after(`<p class="help-block">${txt}</p>`);
        }
    }

    /**
    *
    * @param data {html} - content for insert to block
    * @param resultBlock {string} - result block class
    * @param replaceBlk {string} - replace block class
    */
    insertResult(data, resultBlk, replaceBlk){
        if(replaceBlk !== '' && $(replaceBlk).length !== 0){

           let thisBlk = $(replaceBlk).replaceWithPush(data);
           let classThisBlk = ('.'+thisBlk[0].className.match(/[\d\w-_]+/g).join('.'));

           app.initPluginsInWrapper(classThisBlk);

           if(thisBlk[0].className.split(' ').indexOf('js-update') !== -1){
                new Updating(classThisBlk).init();
           }
        }
        if(resultBlk !== '' && $(resultBlk).length !== 0){
          $(resultBlk).html(data);
          app.initPluginsInWrapper(resultBlk);
        }
    }
}

$(document).ready(function() {
  /**
   * Create jQuery function.
   */
  (function ($) {
    $.fn.replaceWithPush = function(el) {
      let $el = $(el);

      this.replaceWith($el);

      return $el;
    };
  })(jQuery);
});


/*

export let Submit_transfer = function(classForClick, classForChange) {
    this.eventClick = classForClick;
    this.eventChange = classForChange;

    this.init = function(){

        let $body = $('body');
        let clickSel = this.eventClick ;
        let changeSEl = this.eventChange ;

        $body.on('click', clickSel, function(){
            let form = $(this).data('form');
            $(form).submit();
        });
        $body.on('change', changeSEl, function(){
            let form = $(this).data('form');
            $(form).submit();
        });
    };

    this.init()
};*/
