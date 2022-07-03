window._ = require('lodash');

try {
    require('bootstrap');
} catch (e) {}

window.axios = require('axios');
window.$ = require('jquery')
// window.dt = require( 'datatables.net' )()
window.dt = require( 'datatables.net-bs5' )();

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
