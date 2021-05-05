import { alerts } from './alerts';
import '../../../node_modules/jquery-ui/ui/widgets/sortable.js';
import '../../../node_modules/jquery-ui/ui/widgets/mouse.js';
import '../../libs/jquery.ui.touch-punch.min.js'

export let sortable = {
    /**
     * @param classParentItems  class tbody for table or class ul
     */
    init: function(classParentItems){
        $(classParentItems).sortable({
            'ui-floating': 'auto',
            axis: 'y',
            key: "sort",
            //Restricts sort start click to the specified element.
            handle: '.js-sortable-handler',
            deactivate: function( event, ui ) {
                let $parentEl = $(ui.sender[0]);
                let url = $parentEl.attr('data-url');
                let method = $parentEl.attr('data-method');

                if (method === undefined){
                    method = 'POST';
                }

                let referenceId = ui.item[0].id;
                let $referenceId =  $(ui.item[0]);

                let prevElLength = $referenceId.prev().length;

                let reference_entity_id = $referenceId.prev().attr('id');
                let elPosition = 'after';


                if (prevElLength === 0) {
                    elPosition = 'before';
                    reference_entity_id = $referenceId.next().attr('id');
                }

                $.ajax({
                    method: method,
                    url: url,
                    data: {
                        'entity_id': referenceId ,
                        'reference_entity_id': reference_entity_id,
                        'reference_type': elPosition,
                        _token: app.csrf_token
                    },
                    success: function(data) {
                        alerts.success('', app.translate.success);
                    },
                    error: function(){
                        alerts.error('', app.translate.error);
                    }
                });
            }
        });
    }
};