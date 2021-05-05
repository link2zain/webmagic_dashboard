import { alerts } from './alerts.js'


/**
 * Use to sending data from a block with ajax
 *
 * @param blk - block from what will data be sent
 * @param submitBtn - submit button in this block
 */
export class AjaxBlk {

  constructor (blk, submitBtn) {

    this.submitBtn = submitBtn
    this.classBlk = blk

    this.state = {
      method: 'POST',
      action: '',
      reload: false,
      data: '',
      showErrorMsg: true,
      showSuccessMsg: true,
    }
  }

  /**
   * init function
   */
  init () {

    let _this = this;

    app.bodyEl.on('click', this.submitBtn, function (e) {
      e.preventDefault()

      _this.getData(this);
      _this.sendRequest();
    })

  }

  /**
   * get data from block's data attribute
   *
   * @param el - button which parent will be block with data attributes
   */
  getData (el) {

    let blk = $(el).closest(this.classBlk);

    if (blk.attr('data-method') !== undefined) {
      this.state.method = blk.attr('data-method')
    }
    if (blk.attr('data-action') !== undefined) {
      this.state.action = blk.attr('data-action')
    }
    if (blk.attr('data-reload') !== undefined) {
      this.state.reload = blk.attr('data-reload')
    }
    if(blk.attr('data-success-msg') !== undefined){
      this.state.showSuccessMsg = blk.attr('data-success-msg');
    }
    if(blk.attr('data-error-msg') !== undefined){
      this.state.showErrorMsg = blk.attr('data-error-msg');
    }


    this.state.data = blk.find('input, textarea, select').serialize()
  }

  /**
   * ajax request
   */
  sendRequest () {

    let _this = this
    $.ajax({
      url: _this.state.action,
      method: _this.state.method,
      data: _this.state.data,
      success: function () {
        _this.success()
      },
      error: function (data) {
        _this.error(data)
      }
    })
  }

  /**
   * success function
   */
  success () {
    if(this.state.showSuccessMsg){
      alerts.success(app.translate.success )
    }

    $('.form-group').removeClass('has-error');
    $('.help-block').html('')

    if (this.state.reload) {
      setTimeout(function () {
        location.reload()
      }, 200)
    }
  }

  /**
   * error function
   *
   * @param data - data from back
   */
  error (data) {

    $('.form-group').removeClass('has-error');
    $('.help-block').html('');

    let error_msg = [];

    if(!this.state.showErrorMsg) return;

    if (data === undefined || (!data && !data.errors)) {
      alerts.error(app.translate.error);
      return
    }

    let dataObj = JSON.parse(data.response);
    $.each(dataObj.errors, (el) => {
      let errMsg = dataObj.errors[el];
      error_msg.push(`${errMsg} </br>`);
    });

    alerts.error(app.translate.error, error_msg)
  }
}
