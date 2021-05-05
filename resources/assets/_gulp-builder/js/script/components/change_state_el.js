export class ControlStateEl {

  constructor (el) {

    this.element = el;

    this.state = {
      type: '',
      controlElEmpty: true,
      option: ''
    };
    this.elementsControl;
  }

  /**
   * init function
   */
  init () {
    this.elementsControl = this.element.attr('data-control-el');
    this.state.type = this.element.attr('data-control-state'); // 'disable' / 'hidden'
    this.state.controlElEmpty = Boolean(this.element.attr('data-state-active-by-empty')); // true / false
    // only for select control
    let optionVal = this.element.attr('data-control-option');
    if(optionVal){
      this.state.option = optionVal.replace(/\s{2,}/g, '');
    }
    this.changeStateEl();
    this.initUpdateStateByChangeControlEl();
  }
  initUpdateStateByChangeControlEl(){
    app.bodyEl.on('change', this.elementsControl, ()=>{
      this.changeStateEl();
    });
    // app.bodyEl.on('ifChanged', this.elementsControl, ()=>{
    //   this.changeStateEl();
    // });
  }
  changeStateEl(){
    if(this.state.type === 'hidden'){
        if(this.state.controlElEmpty && this.checkHasNotEmptyElControl()){
            this.element.fadeIn(200);
            return;
        }
        if(!this.state.controlElEmpty && !this.checkHasNotEmptyElControl()){
            this.element.fadeIn(200);
            return;
        }
        this.element.fadeOut(200);
        return;
    }
    if(this.state.type === 'disable') {
      if(this.state.controlElEmpty && this.checkHasNotEmptyElControl()){
        this.element.prop('disabled', false);
        return;
      }
    if(!this.state.controlElEmpty && !this.checkHasNotEmptyElControl()){
        this.element.prop('disabled', false);
        return;
    }
      this.element.prop('disabled', true);
    }
  }

  checkHasNotEmptyElControl(){
    let elControlArray = Array.prototype.slice.call($(this.elementsControl));
    let _this = this;
    function isNotEmpty(input) {
      if(input.type == 'checkbox'){
        return $(input).prop('checked');
      }
      if(input.type == 'select-one'){
        return _this.state.option === $(input).val().replace(/\s{2,}/g, '');
      }
      return $(input).val !== '';
    }
    return elControlArray.some(isNotEmpty);
  }
}
