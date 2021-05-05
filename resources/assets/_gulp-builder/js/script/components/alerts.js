export let alerts = {

    /**
     * Show a success alert
     *
     * @param title - a title of a success alert
     * @param txt - a text of a success alert
     */
    success(title = 'Title', txt = '') {

        let $el = $('.alert-section');

        let alertHtml = `<div class="toast bg-success fade show" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">                   
                                <strong class="mr-auto">${title}</strong>
                                <small></small>
                                <button data-dismiss="toast" type="button" class="ml-2 mb-1 close js_remove-btn" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>                             
                            </div>
                            <div class="toast-body">${txt}</div> 
                        </div>`;

        //adds created alert to an alert section on the page
        $el.append(alertHtml);

        $('.toast.bg-success').slideDown();

        app.bodyEl.on('click', '.js_remove-btn', function () {

            let currentBox = $(this).closest('.bg-success');

            //removes an error alert after closing it
            $(currentBox).slideUp(500).promise().done(()=> {
                $(currentBox).remove();
            });
        });

        // hides showed alert in 500 ms
        setTimeout(function() {
            $('.toast.bg-success').first().slideUp(500, function() {
                $(this).remove();
            });
        }, 3000)
    },

    /**
     * Show an error alert
     *
     * @param title - a title of an error alert
     * @param txt - a text of an error alert
     */
    error(title = 'Error', txt = '') {

        let $el = $('.alert-section');

        let alertHtml = `<div class="toast bg-danger fade show" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">                   
                                <strong class="mr-auto">${title}</strong>
                                <small></small>
                                <button data-dismiss="toast" type="button" class="ml-2 mb-1 close js_remove-btn" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>                             
                            </div>
                            <div class="toast-body">${txt}</div> 
                        </div>`;
        //adds created alert to an alert section on the page
        $el.append(alertHtml);

        $('.toast.bg-danger').slideDown();

        app.bodyEl.on('click', '.js_remove-btn', function () {

            let currentBox = $(this).closest('.bg-danger');

            //removes an error alert after closing it
            $(currentBox).slideUp(500).promise().done(()=> {
                $(currentBox).remove();
            });
        });

        // hides showed alert in 500 ms
        setTimeout(function() {
            $('.toast.bg-danger').first().slideUp(500, function() {
                $(this).remove();
            });
        }, 4000)
    }
};
