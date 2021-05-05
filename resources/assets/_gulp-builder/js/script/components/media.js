
//todo decide whether we should delete it or not (it probably is written for files uploading)

/*
Media library functions
 */

export let media = {
    /**
     * Select image for removing
     * @param btn
     */
    select: function(btn) {
        $('body').on('click', btn, function(event) {
            event.preventDefault();
            $(this).parent().parent().parent().toggleClass('__active');
            media.showDeleteSelected();
        });
    },
    /*
    Send request on server to delete image
     */
    delete: function(){
        let itemForDelete = [];
        $('body').find('.media-item.__acitve').each(function(i,el){
            itemForDelete.push($(this).data('id'));
        })
    },
    /*
     Init btn for 1 image delete
     */
    deleteBtnInit: function(btn){
        $('body').on('click', btn, function(e){
            e.preventDefault();
            let id = $(this).data('id');
            media.delete(id);
        })
    },
    /*
    Init button to delete all selected imges
     */
    deleteSelectedInit: function(btn){
        $('body').on('click', btn, function(e){
            e.preventDefault();
            let itemForDelete = [];
            $('body').find('.media-item.__acitve').each(function(i,el){
                itemForDelete.push($(this).data('id'));
            });
            media.delete(itemForDelete);
        })
    },
    /*
    Upload new images
    */
    uploadPreview: function(el) {
        $(el).change(function(event) {
            let files = this.files;
            let container = $(this).parent().find('.media-preview-l');
            container.html('');
            $.each(files, function(index, val) {
                let image = new FileReader();
                image.onload = function(e) {
                    container.append('<li class="media-preview-i"><img src="'+e.target.result+'" alt=""></li>')
                };
                image.readAsDataURL(val);
            });
        });
    },
    checkAllBtnInit: function(btn){
        $('body').on('click', btn, function(e){
            e.preventDefault();
            console.log('click');
            $('body').find('.media-item').addClass('__active');
            media.showDeleteSelected();
        })
    },
    showDeleteSelected: function(){
        if ($('.media-item.__active').length > 0) {
            $('.js-delete-selected').slideDown();
        } else {
            $('.js-delete-selected').slideUp();
        }
    }
};