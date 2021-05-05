let Dropzone = require('dropzone');

/**
 * Class init and setup of plugin dropzone
 * http://www.dropzonejs.com - plugin and documentation
 */
export  class DropZone{

    /**
     * @param options
     *
     * options.initClass - class of init plugin
     * options.availableOptionsFromDataAttr - array with available options which can get from data attribute, names
     *   of data attribute must be related with names of configuration option in plugin (see the doc of plugin)
     */
    constructor(options){
        this.initClass = options.initClass;
        this.availableOptionsFromDataAttr = options.availableOptionsFromDataAttr;
        this.btnSubmitImages = options.btnSubmitImages;
    }

    /**
     * Prepare options
     * Init plugin with our options
     */
    init(){
        let $initClass = $(this.initClass);

        // prepare required options
        let options = {
            url : this.getFormOption('action') || '',
            method : this.getFormOption('method') || 'POST',
            uploadMultiple: true,
            params: {_token: global.app.csrf_token},
            autoProcessQueue: false,
            parallelUploads: 1000,
            addRemoveLinks: true,
        };

        // prepare another options from data attributes
        if(this.availableOptionsFromDataAttr.length){

            this.availableOptionsFromDataAttr.forEach((key)=>{

                let attrKey = key.toLowerCase();

                let option = this.getConfigurationOption(attrKey);

                if(!option) return;

                options[key] = option;
            });
        }
        //init plugin
        Dropzone.autoDiscover = false;
        this.initedPlugin = new Dropzone(this.initClass, options);

        let _this = this;
        // init on click btn submit, submitting images
       app.bodyEl.on('click', this.btnSubmitImages, function () {

            let currentForm = $(this).data('id') + '';

            $(_this.initedPlugin).each(function () {

                if($(this.element).is(currentForm)){
                    this.processQueue()
                }
            });
            // hide remove btn

            $('.dz-remove').hide();
        });
    }

    /**
     * Get url for requests
     *
     * @param option
     * @returns {boolean|string}
     */
    getFormOption(option){
        let $initClass = $(this.initClass);

        let attr = $initClass.attr(option);

        if(attr){
            return attr;
        }

        attr = $initClass.data(option);

        if(attr){
            return attr;
        }

        return false;
    }

    /**
     * Get configuration option from data attribute
     *
     * @param dataAttrName
     * @returns {string|boolean}
     */
    getConfigurationOption(dataAttrName){
        let $initClass = $(this.initClass);

        return $initClass.data(dataAttrName) || false;
    }

}
