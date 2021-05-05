import '../../../node_modules/select2/dist/js/select2';
/**
 * Init Select plugin with different methods
 */
export let select = {
    /**
    * Init simple select plugin
    *
    * @param el - an element on which will bw initialized select plugin
    */
    initDefaultSelect(el) {
        if($(el).length == 0) return;

        $(el).each(function(){
            let $thisSelect = $(this);
            $thisSelect.select2({
                dropdownParent: $thisSelect.parent()
            });
        });
    },
    /**
     * Init select plugin without search field
     *
     * @param el - an element on which will bw initialized select plugin
     */
    initSelectWithoutSearch(el) {
        if($(el).length == 0) return;
        $(el).select2({
            minimumResultsForSearch: Infinity
        });
    },

    /**
     * Init select all functionality both for default checkboxes and for checkboxes with iCheck plugin
     *
     * @param el - a checkbox which will select/deselect all options
     */
    initSelectedAll(el) {
        app.bodyEl.on('change', el, function () {
            select.checkOnChangedCheckbox(this)
        });

        //for checkbox with iCheck plugin
        // $(el).on('ifChanged', function(){
        //     select.checkOnChangedCheckbox(this)
        // });
    },

    /**
     * Checks whether the checkbox has already checked or not
     *
     * @param el - a checkbox which will select/deselect all options
     */
    checkOnChangedCheckbox(el){

        if($(el).is(':checked') ){
            select.selectAll(el);
        }else{
            select.deselectAll(el);
        }
    },

    /**
     * selects all certain select options
     *
     * @param el - a checkbox which will select/deselect all options
     */
    selectAll(el){
        if($(el).length == 0) return;

        let thisSelect = $($(el).attr('data-select'));

        thisSelect.find('option').prop("selected","selected");
        thisSelect.trigger("change");// Trigger change to select 2
    },

    /**
     * deselects all certain select options
     *
     * @param el - a checkbox which will select/deselect all options
     */
    deselectAll(el){
        if($(el).length == 0) return;
        let thisSelect = $($(el).attr('data-select'));

        thisSelect.find('option').removeAttr("selected");
        thisSelect.trigger("change");// Trigger change to select 2
    },

    initSelectWithAjax(el){
        let $el = $(el);
        if($el.length == 0) return;

        $el.each(function(){
            let url = $(this).attr('data-url');
            let placeholder  = $(this).attr('data-placeholder');

            $(this).select2({
                minimumInputLength: 1,
                placeholder: placeholder,
                ajax: {
                    url: url,
                    dataType: 'json',
                    delay: 300,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            _token: app.csrf_token
                        };
                    },
                    processResults: function (data) {
                        return data;
                    }
                },
                templateResult: formatRepo,
                templateSelection: formatRepoSelection
            });
        });
        function formatRepoSelection (repo) {
            return repo.name || repo.text;
        }
        function formatRepo (repo) {
            if (repo.loading) {
                return repo.text;
            }
            return repo.name;
        }
    }
};
