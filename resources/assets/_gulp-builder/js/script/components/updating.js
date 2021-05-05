
/**
 * Updating element by ajax request
 */
export class Updating{
    constructor(el){
        this.elUpdate = $(el);
        this.label = this.elUpdate.attr('data-class');
        this.replace = 0;
        this.intevalId;
        this.dataForUpdate = {
            url : '/',
            method: 'POST',
            timeout: 3000
        };
    }
    init(){
        if(this.elUpdate.attr('data-replace') !== undefined){
            this.replace = Number(this.elUpdate.attr('data-replace'));
        }
        this.getData();
        this.initUpdate();
    }
    /**
     * success function
     *
     * @param data - data which will be append to an element
     */
    success(data){
        let $cntBlk =  $(this.label);
        if($cntBlk.length){
            if(this.replace){
                let thisBlk = $cntBlk.replaceWithPush(data);
                if(thisBlk[0].className){
                    let classThisBlk = ('.'+thisBlk[0].className.match(/[\d\w-_]+/g).join('.'));
                    app.initPluginsInWrapper(classThisBlk);

                    if(thisBlk[0].className.split(' ').indexOf('js-update') !== -1){
                        clearInterval(this.intevalId);
                        new Updating(classThisBlk).init();
                    }
                }
                return;
            }
            $cntBlk.html(data);
            app.initPluginsInWrapper(this.label);
        }
    }
    /**
     * error function
     */
    error(){
        console.log('error update');
    }

    /**
     * get data from data attributes
     */
    getData(){
        if(this.elUpdate.length > 0) {
            let url = this.elUpdate.attr('data-url');
            this.dataForUpdate.url = url !== undefined ? url : this.dataForUpdate.url;

            let method = this.elUpdate.attr('data-method');
            this.dataForUpdate.method = method !== undefined ? method : this.dataForUpdate.method;

            let timeout = this.elUpdate.attr('data-timeout');
            this.dataForUpdate.timeout = timeout !== undefined ? timeout : this.dataForUpdate.timeout;
        }
    }

    /**
     * update function
     */
    initUpdate() {
        if(this.elUpdate.length > 0){
            // Function for call again
            this.intevalId = setInterval(()=> {
                this.sendRequest();
            }, this.dataForUpdate.timeout);
        }
    }
    sendRequest(){
        $.ajax({
            url: this.dataForUpdate.url,
            method: this.dataForUpdate.method,
            data : {_token: app.csrf_token },
            success: (data, textStatus, xhr)=>{
                if (data.redirect !== undefined) {
                    window.location.replace(data.redirect);
                    return;
                }
               /* if(data.update){
                    this.success(data.html);
                }else{
                    clearInterval(this.intevalId);
                }*/
                let header = xhr.getResponseHeader('X-Update-Action');
                if(header == 'update-stop'){
                    clearInterval(this.intevalId);
                }
                if(header == 'update-false'){
                   return;
                }
                this.success(data);
            },
            error : ()=>{
                this.error();
            }
        });
    }
}
