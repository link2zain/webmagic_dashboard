import '../../../node_modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker';

import urlSlug from 'url-slug'
// import urlSlug from '../../libs/urlSlug'

import { alerts } from "./alerts";

import '../../../node_modules/jquery-lazy/jquery.lazy.min';
import '../../../node_modules/jquery-lazy/jquery.lazy.plugins.min';
//import '../../../node_modules/summernote/dist/summernote.min';
//import '../../../node_modules/summernote/dist/summernote-bs4.min';
import {getToken} from "../../libs/getToken";
import '../../libs/summernote';

/**
 * User interface elements init
 *
 */
export let ui = {

    initEditor(elementClass){
        $(elementClass).each(function(){
            let urlUpload = $(this).attr('data-upload-url');
            let disabled = $(this).attr('disabled');
            if (urlUpload) {
                $(this).summernote({
                    height: 200,
                    callbacks: {
                        onImageUpload: function (files) {
                            for (let i = 0; i < files.length; i++) {
                                sendFile(files[i], $(this), urlUpload);
                            }
                        }
                    }
                });
            } else {
                $(this).summernote({
                    height: 200
                })
            }
            if (disabled === 'disabled' || disabled === true){
                $(this).summernote('disable');
            }
        });

        function sendFile(file, editor, action) {
            let data = new FormData();
            data.append("file", file);
            data.append("_token", getToken());
            $.spinnerAdd();
            $.ajax({
                data: data,
                type: "POST",
                url: action,
                cache: false,
                contentType: false,
                processData: false,
                success: function (url) {
                    editor.summernote('insertImage', url);
                    $.spinnerRemove();
                },
                error: function (e) {
                    alerts.error('', app.translate.error);
                    $.spinnerRemove();
                }
            });

        }
    },
    initLazyLoad(elClass){
        let $el = $(elClass);
        if($el.length === 0) return;
        $el.Lazy();
    },

    initCheckedAll(elClass){
        app.bodyEl.on('change', elClass, function () {
            ui.selectedAll($(this))
        });

    },
    selectedAll(clickEl){
        let stateCheckbox =  clickEl.prop('checked');
        let $allCheckboxForEl = $(clickEl.attr('data-checked-el'));

        // checkbox without plugin
        $allCheckboxForEl.each(function() {
            $(this).prop('checked', stateCheckbox);
        });
    },
    initResetInputsWithPlugin(){
        app.bodyEl.on('click', 'input[type="reset"]', function (e) {
           e.preventDefault();
           let $form = $(this).closest('form');

           //reset select
           let $selects = $form.find('.js-select2');
           $form.find("option:selected").removeAttr("selected");
           $selects.val(null).trigger('change');

           $form.find('.js_datetime_picker').attr('value', ''); // .val() and .value not working
           $form.find('.js_datetime_picker-end').attr('value', '');

           //reset ckeditor
           /*let $ckeditor = $form.find(".js-ckeditor");
           $ckeditor.each(function (i, el) {
               let idEl = el.id;
               CKEDITOR.instances[idEl].setData('');
           });*/
            let $summernote = $form.find(".js_summernote");
            $summernote.each(function(){
                $(this).summernote('code', '<p><br></p>');
            });

           $form.find('.js_ui-input-file-delete').trigger('click');
        })
    },
    inputFile(classInput){
        if(!$(classInput).length) return;

        let _URL = window.URL || window.webkitURL;
        app.bodyEl.on('change', classInput, function (e) {
            let $parant = $(this).closest('.js_ui-file-preview');
            let $nameImg = $parant.find('.js_ui-input-file-name');
            let $sizeImg = $parant.find('.js_ui-input-file-size');
            let $sizeWHImg = $parant.find('.js_ui-input-file-size-with-height');
            let $defaultImg = $parant.find('.js_ui-input-file-default-img');
            let $img = $parant.find('.js_ui-input-file-preview');
            let $downloadImg = $parant.find('.js_ui-input-file-download');

            if (this.files && this.files[0]) {
                let img = new Image();
                img.onload = function () {

                    $defaultImg.hide();
                    $img.attr('src',  img.src).fadeIn(200);
                    $downloadImg.attr('href',  img.src).removeClass('disabled');
                    $sizeWHImg.html(this.width + " * " + this.height + 'px');

                };
                img.src = _URL.createObjectURL(this.files[0]);

                $nameImg.text(this.files[0].name);
                $sizeImg.html(formatBytes(this.files[0].size));
            }
        });
        app.bodyEl.on('click', '.js_ui-input-file-delete', function (e) {
            e.preventDefault();
            let $parant = $(this).closest('.js_ui-file-preview');
            let $defaultImg = $parant.find('.js_ui-input-file-default-img');

            if($defaultImg.is(':visible')) return;

            let $nameImg = $parant.find('.js_ui-input-file-name');
            let $sizeImg = $parant.find('.js_ui-input-file-size');
            let $img = $parant.find('.js_ui-input-file-preview');
            let $inputFile = $parant.find(classInput);
            let $sizeWHImg = $parant.find('.js_ui-input-file-size-with-height');
            let $downloadImg = $parant.find('.js_ui-input-file-download');

            $defaultImg.fadeIn(200);
            $img.attr('src', '').hide();
            $inputFile.val('');
            $nameImg.html('');
            $sizeImg.html('');
            $sizeWHImg.html('');
            $downloadImg.attr('href', '').addClass('disabled');
        });
        function formatBytes(bytes, decimals) {
            if(bytes == 0) return '0 Bytes';
            var k = 1000,
                dm = decimals <= 0 ? 0 : decimals || 2,
                sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
                i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
        }
    },


    /**
     * init Color picker plugin
     *
     * @param el - element on which will be init plugin
     */
    color_picker(el){
        $(el).colorpicker();
    },

    /**
     * scroll to the top of the site
     *
     * @param el - button which you click on to scroll up.
     */

    addScrollClass(el){
        $(window).scroll(function() {
            if ($(window).scrollTop() > 50) {
                $(el).fadeIn(400);
            }
            else{
                $(el).fadeOut(400);
            }
        });
    },

    /**
     * generate slug for url
     *
     * @param inpSlug - input which generate slug
     */
    getSlugUrl(inpSlug){
        let inpName = $(inpSlug).attr('data-source-name');
        let separatorSlug = $(inpSlug).attr('data-separator');
        let transformerSlug = $(inpSlug).attr('data-transformer');
        let transformer;

        let inpSource = $(inpSlug).closest('form').find('[name="'+inpName+'"]:first');

        $(inpSource).keyup(function(){
            let inpVal = $(this).val();

            if(transformerSlug === 'false'){
                transformer = false;
            }
            else if(transformerSlug === 'uppercase'){
                transformer = urlSlug.transformers.uppercase;
            }
            else{
                transformer = urlSlug.transformers.lowercase;
            }
            let resultSlug = urlSlug(inpVal, separatorSlug ? separatorSlug : '-', transformer ? transformer : urlSlug.transformers.lowercase);
            $(inpSlug).val(resultSlug);
        });
    },
};
