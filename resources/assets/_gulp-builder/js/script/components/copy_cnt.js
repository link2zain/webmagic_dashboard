export let copyContent = {
    /**
     * init function
     */
    init(btnClass){
        let _this = this;
        app.bodyEl.on('click',  btnClass,  function (e) {
            e.preventDefault();
            let $elCopy = $($(this).attr('data-el'));
            let cntCopy = $(this).attr('data-copy');
            if($elCopy.length){
                if($elCopy.prop("tagName") == 'INPUT' || $elCopy.prop("tagName") == 'TEXTAREA'){
                    _this.copyText($elCopy.val());
                }else{
                    _this.copyText($elCopy.text());
                }
            }
            if(cntCopy){
                _this.copyText(cntCopy);
            }
        })
    },
    copyText(text){
        let dummy = document.createElement('input');
        document.body.appendChild(dummy);
        dummy.value = text;
        dummy.select();
        dummy.setSelectionRange(0, 99999);
        document.execCommand('copy');
        document.body.removeChild(dummy);
    }
}

