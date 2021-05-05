/**
 * Base app object
 * @type {{init: Function}}
 */

import { getToken } from '../libs/getToken';
import { getLocale } from './components/locale';

import { SendAjaxFromEl } from "./components/ajax_el";
import { AjaxForm }  from './components/ajax_form.js'
import { AjaxBlk } from "./components/ajax_blk";

import { ControlStateEl } from "./components/change_state_el"
import { Updating } from "./components/updating";
import { item } from './components/item.js';
import { Datatime_picker } from './components/data_range.js'
import { fields } from './components/requests.js'
import { sortable } from './components/sortable.js'
import { Graphic } from './components/graphics';
import { select } from './components/select.js'
import { DropZone } from "./components/dropzone";

import { Uploader } from "./components/uploader";

import '../../node_modules/bootstrap/dist/js/bootstrap';

import { UploadFilePond } from "./components/filepond";

import  '../../node_modules/overlayscrollbars/js/jquery.overlayScrollbars';
import  '../../node_modules/overlayscrollbars/js/OverlayScrollbars';
import '../../node_modules/admin-lte/dist/js/adminlte';


import {controls} from "./components/controls";
import { copyContent } from "./components/copy_cnt";
import { ui } from './components/ui_components.js';

import 'prismjs';
import 'prismjs/components/prism-clike';
import 'prismjs/components/prism-markup-templating';
import 'prismjs/components/prism-php';

$(document).ready(function() {
    global.app = new App();
    global.app.init();
});

class App {
    constructor(){
        let localeSettings = getLocale();
        this.locale = localeSettings.locale ;
        this.csrf_token = getToken();
        this.bodyEl = $('body');
        this.translate = controls.getTranslate(this.locale);
    }

    init() {
        ui.getSlugUrl('.js_get-slug');
        ui.addScrollClass('.js_scroll-top');
        //Init filePond
        this.uploadFilePondInit();

        this.initPluginsInWrapper();

        copyContent.init('.js_copy-cnt');

        ui.initCheckedAll('.js_select-all');
        ui.initResetInputsWithPlugin();

        //
        item.create_btn_init('.js_create');
        item.delete_btn_init('.js_delete');

        //init data tables
        // dataTables.init('.js_data_table');

        //init image uploading
        // image.uploadPreview('.js_image-preview');




        //Init multi fields
        fields.init({
            src: '.js-src',
            dest: '.js-copy-dest',
            item: '.js-copy-item',
            add_btn:  '.js-add',
            remove_btn: '.js-remove'
        });

        //init all graphics
        this.initAllGraphics();
        //Init dropzone
        this.dropzoneInit();
        //Init uploader
        this.uploaderInit();

       /* // Init Daterangetimepicker plugin
        $('.js_datetime_picker').each(function () {
            let datatimepicker = new Datatime_picker(this);
            datatimepicker.init();
        });*/

        // Delete tooltip
        $('.js_hide-tooltip').each(function() {
            $(this).tooltip('disable');
        });
        /**
         * Initialize ajax sending form
         */

        let pagination = new SendAjaxFromEl('.js_btn-pagination', 'click', this.initPluginsInWrapper);
        pagination.onInit();

        let sendAjaxByClick = new SendAjaxFromEl('.js_ajax-by-click-btn', 'click', this.initPluginsInWrapper);
        sendAjaxByClick.onInit();

        let sendAjaxByChange = new SendAjaxFromEl('.js_ajax-by-change', 'change', this.initPluginsInWrapper);
        sendAjaxByChange.onInit();

        let sendFormByClickEl = new SendAjaxFromEl('.js_submit-form-by-click-el', 'click', this.initPluginsInWrapper, true);
        sendFormByClickEl.onInit();
        let sendFormByChangeEl = new SendAjaxFromEl('.js_submit-form-by-change-el', 'change', this.initPluginsInWrapper, true);
        sendFormByChangeEl.onInit();

        /**
         * Initialize sending ajax request with data from block (without form)
         */
        let submitDateFromBlk = new AjaxBlk('.js_ajax_blk-blk-submit', '.js_ajax_blk-btn-submit');
        submitDateFromBlk.init();
    }


    initPluginsInWrapper(wrapper = ''){
        // console.log('init plugin  ' + wrapper)

        // Init Daterangetimepicker plugin
        $(wrapper + ' ' + '.js_datetime_picker').each(function () {
            let datatimepicker = new Datatime_picker(this);
            datatimepicker.init();
        });

      //init all selects
      select.initDefaultSelect(wrapper + ' ' +'.js-select2');
      select.initSelectWithoutSearch(wrapper + ' ' +'.js_ui-base-select');
      select.initSelectedAll(wrapper + ' ' +'.js_ui-checkbox-selected-all');
      select.initSelectWithAjax(wrapper + ' ' + '.js-select2-ajax');

      ui.initLazyLoad(wrapper + ' ' +'.js-lazy');

      ui.inputFile(wrapper + ' ' +'.js_ui-input-file');

      // Sortable init, for now bower can't load library, and i commented it
      sortable.init(wrapper + ' ' + '.js-sortable');

      //init tooltip
      $(wrapper + ' ' +'*').tooltip({
        track: true,
      });
      $(wrapper + ' ' +'[title]').on("click", function() {
        $("div[role=tooltip]").remove();
      });
      $(wrapper + ' ' +'#menu *[title]').tooltip('disable');
      $(wrapper + ' ' +'[data-toggle="tooltip"]').tooltip("dispose");

      //init text editor
      //ui.editor_init(wrapper + ' ' +'.js-ckeditor');

      // Init Date-time piker plugin
      $(wrapper + ' ' +'.js_datetime_picker').each(function () {
        let datatimepicker = new Datatime_picker(this);
        datatimepicker.init();
      });

      $(wrapper + ' ' +'.js_control-state').each(function () {
          let controlState = new ControlStateEl($(this));
          controlState.init();
      });

      $(wrapper + ' ' +'.js-update').each(function (i, el) {
        let updateCnt = new Updating(el);
        updateCnt.init();
      });

      let ajax_form = new AjaxForm(wrapper + ' ' + '.js-submit');
      ajax_form.init();

      //init Color picker
      ui.color_picker(wrapper + ' ' +'.js-color-pick');

      $(wrapper + ' ' +'.js_show-scroll').overlayScrollbars({
            className: "os-theme-light",
            sizeAutoCapable: true,
            scrollbars: {
                autoHide: "l",
                clickScrolling: true
            }
      });
      //init Summernote for textarea
      ui.initEditor(wrapper + ' ' +'.js_summernote')

    }

    /**
     * Init all graphics
     */
    initAllGraphics(){
        let $graphics = $('.js_graphic');
        if(!$graphics.length) return;

        $graphics.each(function(){

            let $graphicOptions = $(this).data('options');
            if($graphicOptions == undefined) return;

            let objOptionsGraphic = JSON.parse(JSON.stringify( $graphicOptions));

            let graphic = new Graphic(objOptionsGraphic);
            graphic.init();
        });
    }

    /**
     * Init dropzone
     *
     * to more information go to dropzone init file
     */
    dropzoneInit(){
        let $dropzoneInit = $('.js_dropzone-init');
        if(!$dropzoneInit.length) {
            return;
        }

        // each element init
        $dropzoneInit.each((i, el)=>{
            // get name of class if need, to have ability affect to each class
            let name = $(el).data('class-name');

            if(!name) {
                name = `dropzone_${i}`;
            }

            if(this[name] !== undefined){
                console.error('Error in file main.js on function dropzoneInit, try to init class with name which already exist - ' + name);
                return false;
            }

            this[name] = new DropZone({
                initClass: el,
                btnSubmitImages: '.js_dropzone-submit',
                availableOptionsFromDataAttr : [
                    'maxFilesize',
                    'paramName',
                    'uploadMultiple',
                    'addRemoveLinks',
                    'acceptedFiles',
                ]
            });

            this[name].init();
        });
    }

    //Fine Uploader
    uploaderInit(){
        let $uploader  = $('.js_uploader');
        if(!$uploader.length) {
            return;
        }

        // each element init
        $uploader.each((i, el)=>{
            // get name of class if need, to have ability affect to each class
            let name = $(el).data('class-name');

            if(!name) {
                name = `uploader_${i}`;
            }

            if(this[name] !== undefined){
                console.error('Error in file main.js on function uploaderInit, try to init class with name which already exist - ' + name);
                return false;
            }

            this[name] = new Uploader({
                element: el,
                availableOptionsFromDataAttr : [
                    'itemLimit',
                    'request-endpoint',
                    'deleteFile-endpoint',
                    'deleteFile-enabled',
                    'sizeLimit'
                ]
            });

            this[name].init();
        });

    }

    //filePond plugin init
    uploadFilePondInit(){
        let $uploaderFile = $('.js_filepond');
        if(!$uploaderFile.length) {
            return;
        }
        $uploaderFile.each((i, el)=>{
            let filePondEl = new UploadFilePond({
                element: el
            });
            filePondEl.init();
        });
    }
}

