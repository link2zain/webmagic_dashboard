//JQuery
//require('expose?$!expose?jQuery!jquery');
import $ from 'jquery';

global.jQuery = $;
global.$ = $;

//JQuery Mask
// import './maskedinput.min.js';

//magnificPopup
import '../../node_modules/magnific-popup/dist/jquery.magnific-popup'

//Spinner
import './spinner';

//Bootstrap
// import '../../bower_components/adminlte/bootstrap/js/bootstrap.min.js'
// import '../../node_modules/bootstrap/dist/js/bootstrap'


/**
 * Save state for menu
 */
$(document).on('collapsed.pushMenu', function () {
  localStorage.setItem("sidebarCollapse", true);
});
$(document).on('expanded.pushMenu', function () {
  localStorage.setItem("sidebarCollapse", false);
});


//Data Table
// import '../../node_modules/datatables/media/js/jquery.dataTables'
// import '../../node_modules/datatables.net-select/js/dataTables.select'
// import '../../node_modules/jquery-datatables-checkboxes/js/dataTables.checkboxes.min'
// import './dataTables.bootstrap.js'

import '../../node_modules/fine-uploader/fine-uploader/fine-uploader.min'



import '../../node_modules/jquery-ui/ui/widget';
import '../../node_modules/jquery-ui/ui/data';
import '../../node_modules/jquery-ui/ui/scroll-parent.js';
import '../../node_modules/jquery-ui/ui/widgets/mouse.js';

