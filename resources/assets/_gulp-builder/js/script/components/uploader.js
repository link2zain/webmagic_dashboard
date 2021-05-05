
import qq from 'fine-uploader';

import { sortable } from '../components/sortable'

/**
 * Class init and setup of plugin fine uploader
 * https://fineuploader.com/ - plugin and documentation
 */

export  class Uploader{

    constructor(options){
        this.element = options.element;
        this.availableOptionsFromDataAttr = options.availableOptionsFromDataAttr;
    }

    init(){
        let el = this.element;

        $(el).closest('form').attr('id', 'qq-form');

        let options = {
            element: el,
            callbacks:{
                onSubmitted: function () {
                    $('.qq-upload-list').addClass('js-sortable-without-handler');
                    $('.qq-upload-list li').each(function (i, el) {
                        $(el).addClass('js-sortable-i');
                        $(el).attr('id', `js-sortable_${i}`);
                        sortable.init('.js-sortable');
                    });
                }
            },
        };

        new qq.FineUploader(options);

        // prepare options from data attributes
        if(this.availableOptionsFromDataAttr.length){

            this.availableOptionsFromDataAttr.forEach((key)=>{

                //take a key from main.js and make it an option of the object
                let attrKey = key.toLowerCase();
                let option = this.getConfigurationOption(attrKey);

                if(!option) return;

                //if an option has dashes it means that this option will have child options
                //this check wil prepare an option from the first part before a dash
                if (key.indexOf('-') !== -1) {

                    let newKey = key.substr(0, key.indexOf('-'));

                    //if we have more than one child option we will add them one after another
                    if(options[newKey]) {
                        Object.assign(options[newKey], option);
                        return;
                    }

                    return options[newKey] = option;

                }
            });
        }
    }

    /**
     * Get configuration option from data attribute
     *
     * @param dataAttrName
     * @returns {string|boolean}
     */
    getConfigurationOption(dataAttrName){
        let el = this.element;

        //if an option has dashes takes a part after dash and make it the suboption and takes it value from data-attribute
        if (dataAttrName.indexOf('-') !== -1) {
            let suboption = dataAttrName.split('-')[1];
            let value = $(el).data(dataAttrName);
            let newObj = {};

            newObj[suboption] = value;

            return newObj;
        }

        return $(el).data(dataAttrName) || false;
    }

}