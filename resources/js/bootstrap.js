window._ = require('lodash');
import 'bootstrap';
import $ from 'jquery'; // Import jQuery first
import DataTable from 'datatables.net-bs5';
import 'datatables.net-bs5/css/dataTables.bootstrap5.min.css'; // Use Bootstrap 5 styles

import jszip from 'jszip';
import pdfMake from 'pdfmake';
import pdfFonts from 'pdfmake/build/vfs_fonts';
pdfMake.vfs = pdfFonts
import 'datatables.net-autofill-bs5';
import 'datatables.net-buttons-bs5';
import 'datatables.net-buttons/js/buttons.colVis.mjs';
import 'datatables.net-buttons/js/buttons.html5.mjs';
import 'datatables.net-buttons/js/buttons.print.mjs';
import 'datatables.net-colreorder-bs5';
import DateTime from 'datatables.net-datetime';
import 'datatables.net-fixedcolumns-bs5';
import 'datatables.net-fixedheader-bs5';
import 'datatables.net-keytable-bs5';
import 'datatables.net-responsive-bs5';
import 'datatables.net-rowgroup-bs5';
import 'datatables.net-rowreorder-bs5';
import 'datatables.net-scroller-bs5';
import 'datatables.net-searchbuilder-bs5';
import 'datatables.net-searchpanes-bs5';
import 'datatables.net-select-bs5';
import 'datatables.net-staterestore-bs5';

// Ensure jQuery is globally available before using DataTables plugins
window.$ = window.jQuery = $;
window.JSZip = jszip;  // Fix JSZip for exporting functionality
window.pdfMake = pdfMake;

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

$(document).ready(function () {
    window.$ = window.jQuery = $;
    let table = new DataTable('#dt', {
        responsive: true,
        dom: 'Bfrtip', // Enable buttons
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
        ],
    });
});
