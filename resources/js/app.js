// Bootstrap
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

// jQuery
import jQuery from 'jquery';
window.$ = jQuery;

// DataTables
import 'laravel-datatables-vite';

// Select2
import select2 from 'select2';
select2();

// Now import daterangepicker after moment is exposed globally
import 'daterangepicker/daterangepicker.css';
import 'daterangepicker';

// Jquery Validation
import 'jquery-validation';

// Toast
import 'jquery-toast-plugin';