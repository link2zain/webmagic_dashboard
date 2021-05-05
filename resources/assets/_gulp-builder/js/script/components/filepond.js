//FilePond plugin

import 'custom-event-polyfill';
import "core-js/stable";
import '../../libs/jqueryFilePond';
import {getToken} from '../../libs/getToken';

export class UploadFilePond{

    constructor(options){
        this.element = options.element;
        this.url = '';
        this.urlDelete = '';
    }

    init(){
        let $el = $(this.element);
        this.url = $el.attr('data-url');
        this.urlDelete = $el.attr('data-url-delete');
        let files =  JSON.parse($el.attr('data-files').replace(/'/g, '"'));

        let filesArr = [];
        let _this = this;

        if(Array.isArray(files)){
            files.forEach((item)=>{
                filesArr.push({
                    source: item,
                    options: {
                        type: 'local',
                    }
                });
            });
        }
        $el.filepond({
            files: filesArr,
            styleItemPanelAspectRatio: '1',
            server: {
                process: {
                    url: _this.url,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': app.csrf_token,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    withCredentials: false,
                },
                load: (uniqueFileId, load) => {
                    // you would get the file data from your server here
                    fetch(uniqueFileId)
                        .then(res => res.blob())
                        .then(load);
                    let fileNames = [];
                    if (filesArr.length > 0){
                        filesArr.map((el)=>{
                            //fileNames.push(el.source.match(/\/([^/]*)$/)[1])
                            fileNames.push(el.source)
                        });
                        _this.addFileNames(fileNames);
                    }
                },
                revert: (uniqueFileId, load, error) => {
                    _this.removeFile(uniqueFileId);
                    load();
                },
                remove: (source, load, error) => {
                    // Should somehow send `source` to server so server can remove the file with this source
                    _this.removeFile(source);

                    // Can call the error method if something is wrong, should exit after
                    error('oh my goodness');
                    load();
                }
            },
            onprocessfile: function(error, file) {
                let dataFile = $el.filepond('getFiles');
                let fileNames = [];
                if(dataFile){
                    dataFile.map((el)=>{
                        if(el.serverId !== null){
                            fileNames.push(el.serverId)
                        }
                    });
                    _this.addFileNames(fileNames);
                }
            }
        });
    }
    removeFile(id){
        let data = {
            id: id,
            _token: getToken(),
            _method: 'DELETE',
        };
        let url = this.urlDelete ? this.urlDelete : this.url;

        $.ajax({
            url: url,
            method: "POST",
            data: data,
            cache: false,
            success: (data) => {
                // console.log(data)
            }
        });
    }
    addFileNames(fileNames){
        let inpFile = $(this.element).attr('data-files-names-input');
        if(inpFile){
            $(`input[name$="${inpFile}"`).val(JSON.stringify(fileNames));
        }
    }
}
