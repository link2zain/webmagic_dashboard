import { alerts } from './alerts';

import '../../libs/spinner';
import { Updating } from "./updating";
import { modals } from './modals.js';
import { controls } from './controls.js';


/**
 * Use to sending data attributes  with ajax
 *
 * @param btnClass {string}  - click button class
 * @param typeEvent {string} - name event
 * @param parentForm {boolean} -class parent for submit
 * @param initPluginFunction {Function} -callback for reinit plugins
 *
 */

export class SendAjaxFromEl{

  constructor(btnClass, typeEvent, initPluginFunction,  parentForm ){

    this.btn = btnClass;
    this.typeEvent = typeEvent;
    this.initPlugin = initPluginFunction;

    this.parentForm = parentForm === true ? parentForm : false;

    this.method = "POST";
    this.action = '/';
    this.data = {};

    this.resultBlk ='';
    this.replaceBlk ='';
    this.modal = false;
    this.modalHide = true;
    this.confirm = {
      status: true,
      ttl: '',
      cnt: '',
      btnTxt: '',
      btnCancelTxt: ''
    };
    this.modalTtl = '';
    this.modalSize = '';
    this.reloadAfterCloseModal = false;
    this.reloadAfterSuccess = false;
    this.successMsg = true;
    this.errorMsg = true;
  }

  /**
   * init function
   */
  onInit(){
    let _this = this;

    app.bodyEl.on(this.typeEvent, this.btn, function(e){
      if(e.type === 'click'){
        e.preventDefault();
      }
      _this.getConfirmData($(this));

      if(_this.parentForm){
        let $elForSubmit = $($(this).attr('data-form'));
        if($elForSubmit.length != 0){
          _this.data = _this.getData($elForSubmit);
          if($(this).attr('data-modal-hide') == false || $(this).attr('data-modal-hide') == 'false' || $(this).attr('data-modal-hide') == '0'){
            _this.modalHide = false;
          }else{
            _this.modalHide = true;
          }

        }
      }else{
        _this.data = _this.getData($(this));
      }


      if(_this.confirm.status){
        _this.showConfirmModal();
      }else{
        _this.addSpinner('formsendHover', 'form-loading');
        _this.sendRequest();
      }

    });
    let $modal_result = $('.js_base_modal_empty');
    $modal_result.on('hidden.bs.modal', function() {
      $modal_result.removeAttr('data-result-blk').removeAttr('data-replace-blk');
    });
  }
  showConfirmModal(){
    let _this = this;
    let $modal_el = $('.js_base_modal');

    modals.set_content($modal_el, this.confirm.ttl, this.confirm.cnt, this.confirm.btnTxt, this.confirm.btnCancelTxt);

    $modal_el.one('click', '.js_confirm_btn', ()=> {
      $modal_el.modal('hide');
      _this.addSpinner('formsendHover', 'form-loading');
      _this.sendRequest();
      $modal_el.off('click', '.js_confirm_btn');
    });
    $modal_el.on('hidden.bs.modal', function (e) {
      $modal_el.off('click', '.js_confirm_btn');
    });

    $modal_el.modal();
  }
  addSpinner(idSpinner, classLoader){
    if($(this.btn).closest('.js_base_modal_empty').length !== 0){
      $('.js_base_modal_empty .modal-content').spinnerAdd(idSpinner, classLoader);
      return;
    }

    if($(this.resultBlk).length !== 0){
      $(this.resultBlk).spinnerAdd(idSpinner, classLoader);
      return;
    }
    if($(this.replaceBlk).length !== 0){
      $(this.replaceBlk).spinnerAdd(idSpinner, classLoader);
      return;
    }
    $.spinnerAdd(idSpinner, classLoader)
  }
  /**
   * get data from button
   *
   * @param el - button with data attributes
   */
  getData(el){
    let data = el.data();

    if(el.attr('data-replace-blk') !== undefined ){
      this.replaceBlk = el.attr('data-replace-blk');
    }
    if(data.replaceBlk !== undefined){
      delete data.replaceBlk;
    }
    if(el.attr('data-result-blk') !== undefined ){
      this.resultBlk = el.attr('data-result-blk');
    }
    if(data.resultBlk !== undefined ){
      delete data.resultBlk;
    }

    if(el.attr('data-modal') !== undefined){
        this.modal = el.attr('data-modal');
        this.modalTtl = el.attr('data-modal-ttl') !== undefined ? el.attr('data-modal-ttl') : '';
        this.modalSize = el.attr('data-modal-size') !== undefined ? el.attr('data-modal-size') : '';
        this.reloadAfterCloseModal = el.attr('data-reload-after-close-modal') !== undefined ?  el.attr('data-reload-after-close-modal') : false;
    }
    if(data.modal !== undefined){
      delete data.modal;
      delete data.modalTtl;
      delete data.modalSize;
      delete data.reloadAfterCloseModal;
      delete data.reloadAfterSuccess;
    }


    if(data.confirm !== undefined){
      delete data.confirm;
      delete data.confirmTtl;
      delete data.confirmCnt;
      delete data.confirmBtnTxt;
      delete data.confirmBtnCancelTxt;
    }

    if(el.attr('data-modal-hide') == false || el.attr('data-modal-hide') == 'false' || el.attr('data-modal-hide') == '0'){
      this.modalHide = false;
    }else{
      this.modalHide = true;
    }

    if(data.modalHide !== undefined){
      delete data.modalHide;
    }

    if(data.reloadAfterSuccess !== undefined){
      delete data.reloadAfterSuccess;
    }

    if(el.attr('data-reload-after-success') !== undefined){
      this.reloadAfterSuccess = el.attr('data-reload-after-success') == 'true' || el.attr('data-reload-after-success') == 1 ?  true : false;
    }

    if(data.successMsg !== undefined){
      this.successMsg = data.successMsg;
      delete  data.successMsg;
    }
    if(data.errorMsg !== undefined){
      this.errorMsg = data.errorMsg;
      delete  data.errorMsg;
    }

    //the el is form
    if(el.is('form')){
      return this.getDataForm(el, data);
    }

    //the el is not form
    if(data.method !== undefined){
      delete data.method;
    }
    if(el.attr('data-method') !== undefined){
      this.method = el.attr('data-method');
    }

    if(data.action !== undefined ){
      delete data.action;
    }
    if(el.attr('data-action') !== undefined ){
      this.action = el.attr('data-action');
    }

    //remove data  plugins
    data = this.removePluginAttributes(data);

    //for element form (example: checkbox or select)
    let nameEl = el.attr('name');

    if(!(nameEl == undefined || nameEl == '') ){
      if(el[0].type && el[0].type === 'checkbox'){
        if(el[0].checked){
          data[nameEl] = 1;
        }else {
          data[nameEl] = 0;
        }
      }else{
        data[nameEl] = el.val();
      }
    }
    data._token = app.csrf_token;
    console.log (data['bs.tooltip']);
    return data;
  }
  getConfirmData(el){
    this.confirm.status = (el.attr('data-confirm') == true ||
          el.attr('data-confirm') == 'true' ||
          el.attr('data-confirm') == 1) ? true : false;

    if(el.attr('data-confirm') !== undefined){

      this.confirm.ttl = el.attr('data-confirm-ttl') !== undefined ? el.attr('data-confirm-ttl') : app.translate.modalConfirmTtlDefault;
      this.confirm.cnt = el.attr('data-confirm-cnt') !== undefined ? el.attr('data-confirm-cnt') : app.translate.modalConfirmCntDefault;
      this.confirm.btnTxt = el.attr('data-confirm-btn-txt') !== undefined ? el.attr('data-confirm-btn-txt') : app.translate.modalConfirmBtnTxtDefault;
      this.confirm.btnCancelTxt = el.attr('data-confirm-btn-cancel-txt') !== undefined ? el.attr('data-confirm-btn-cancel-txt') : app.translate.modalConfirmBtnCancelTxtDefault;
    }
  }
  removePluginAttributes(data){
    if(data['bs.tooltip'] !== undefined) {
      delete data['bs.tooltip'];
    }
    if(data['select2'] !== undefined){
      delete data['select2'];
    }
    if(data['datepicker'] !== undefined){
      delete data['datepicker'];
    }
    return data;
  }

  /**
   * @param form {el}
   * @param data {object}
   */
  getDataForm(form, data){
    if(form.attr('action') !== undefined){
      this.action = form.attr('action');
    }
    if(form.attr('method') !== undefined){
      this.method = form.attr('method');
    }

    //checkbox
    let checkbox = form.find("input[type=checkbox]");

    checkbox.each(function(item, el){
      if (el.checked) {
        el.value = 1
      }
      if (data.sendAllCheckbox && !el.checked) {
        el.value = 0
      }
    });
    return form.serialize();
  }
  /**
   * ajax request
   */
  sendRequest(){
    if(this.method.toUpperCase() !== 'GET' && this.method.toUpperCase() !== 'POST'){
      this.data._method = this.method;
      this.method = 'POST';
    }
    this.data = this.removePluginAttributes(this.data);
    $.ajax({
      url: this.action,
      method: this.method,
      data: this.data,
      success: (data) => {
        if (data.redirect !== undefined) {
          window.location.replace(data.redirect);
          return;
        }
        this.successSubmit(data);
      },
      error: (data) => {
        this.errorSubmit(data);
      }
    })
  }

  /**
   * append data to resultBlk
   * @param data - data from back
   */
  successSubmit(data){

    let $modalCnt = $('.js_base_modal_empty');
    if(this.modal && !$modalCnt.is(":visible")){
      $.spinnerRemove('formsendHover', 'form-loading');

      console.log('modal 1');

      $modalCnt.attr('data-result-blk', this.resultBlk);
      $modalCnt.attr('data-replace-blk', this.replaceBlk);
      $modalCnt.attr('data-reload-after-close-modal', this.reloadAfterCloseModal);


      /*reload page after close modal */
      if(this.reloadAfterCloseModal){
        $modalCnt.on('hidden.bs.modal', function (e) {
          location.reload();
        })
      }

      $modalCnt.modal('show').find('.modal-body').html(data);
      $modalCnt.find('.modal-dialog').addClass(this.modalSize);

      $modalCnt.find('.modal-header .modal-title').remove();
      $modalCnt.find('.modal-header').prepend('<h4 class="modal-title">'+this.modalTtl+'</h4>');

      //reinit plugin
      if(typeof  this.initPlugin == 'function') {
        this.initPlugin('.js_base_modal_empty');
      }
      return;
    }

    if(this.reloadAfterSuccess){
      location.reload();
    }

    if($(this.btn).closest('.js_base_modal_empty').length !== 0 && this.modalHide){
      console.log('in modal event')
      this.resultBlk = $modalCnt.attr('data-result-blk') === undefined ? '' : $modalCnt.attr('data-result-blk');
      this.replaceBlk = $modalCnt.attr('data-replace-blk') === undefined ? '' : $modalCnt.attr('data-replace-blk');
      $modalCnt.modal('hide');

    }
    if(this.replaceBlk !=='' && $(this.replaceBlk).length !== 0){
      let thisBlk =  $(this.replaceBlk).replaceWithPush(data);
      if(typeof  this.initPlugin == 'function'){
        let classThisBlk = ('.'+thisBlk[0].className.match(/[\d\w-_]+/g).join('.'));
        this.initPlugin(classThisBlk);
        if(thisBlk[0].className.split(' ').indexOf('js-update') !== -1){
          new Updating(classThisBlk).init();
        }
      }
      $.spinnerRemove('formsendHover', 'form-loading');
      return;
    }

    if(this.resultBlk !=='' && $(this.resultBlk).length !== 0){
      $(this.resultBlk).html(data);
      if(typeof  this.initPlugin == 'function') {
        this.initPlugin(this.resultBlk);
      }
    }
    if(this.successMsg){
      alerts.success('Done');
    }
    $.spinnerRemove('formsendHover', 'form-loading');
  }

  /**
   * error function
   *
   * @param data - data from back
   */
  errorSubmit(data){
    $.spinnerRemove('formsendHover', 'form-loading');
    if(data === undefined || ( !data.responseJSON && !data.responseJSON.errors)){
      if(this.errorMsg) alerts.error('Error');
      return;
    }
    if(this.errorMsg) {
      alerts.error(data.responseJSON.message);
    }
  }
}
