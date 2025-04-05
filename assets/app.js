/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap( Twig function),
 * which should already be in your base.html.twig.
 */

import './styles/app.css';

// Fonts
//import 'https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap';
import './src/assets/css/light/custom.css'
import './src/assets/css/light/authentication/auth-boxed.css'
import './src/assets/css/dark/authentication/auth-boxed.css'
import './layouts/vertical-light-menu/css/light/loader.css'
import './layouts/vertical-light-menu/css/dark/loader.css'
import './layouts/vertical-light-menu/loader'
import './src/bootstrap/css/bootstrap.min.css'
import './layouts/vertical-light-menu/css/light/plugins.css'
import './layouts/vertical-light-menu/css/dark/plugins.css'
import './src/plugins/src/apex/apexcharts.css'
import './src/assets/css/light/components/list-group.css'
import './src/assets/css/dark/components/list-group.css'
import './src/assets/css/light/dashboard/dash_2.css'
import './src/assets/css/dark/dashboard/dash_2.css'
import 'select2/dist/css/select2.min.css'
import 'select2-bootstrap-theme/dist/select2-bootstrap.min.css'
import './src/assets/css/light/components/modal.css'
import './src/assets/css/dark/components/modal.css'
import './src/plugins/css/light/table/datatable/dt-global_style.css'
import './src/plugins/css/dark/table/datatable/dt-global_style.css'
import './src/plugins/css/light/perfect-scrollbar/perfect-scrollbar.css'
import './src/plugins/css/dark/perfect-scrollbar/perfect-scrollbar.css'
import './src/assets/css/light/scrollspyNav.css'
import '@fortawesome/fontawesome-free/css/all.css'
import './src/plugins/src/font-icons/fontawesome/css/fontawesome.css'
import './src/plugins/src/font-icons/fontawesome/css/regular.css'
import "./src/plugins/src/sweetalerts2/sweetalerts2.css";
import "./src/assets/css/light/widgets/modules-widgets.css";
import "./src/assets/css/dark/widgets/modules-widgets.css"


import $ from 'jquery';
global.$ = global.jQuery = $;

require('@popperjs/core/dist/cjs/popper')
require('inputmask')


const feather = require('feather-icons')
global.feather = feather
feather.replace();

const Swal = require('sweetalert2');
global.Swal = Swal;

import './src/bootstrap/js/bootstrap.bundle.min'
import './src/plugins/src/perfect-scrollbar/perfect-scrollbar.min'
import './src/plugins/src/mousetrap/mousetrap.min'
import './src/plugins/src/waves/waves.min'
import './layouts/vertical-light-menu/app'
import './src/plugins/src/apex/apexcharts.min'
import './src/assets/js/dashboard/dash_2'
import 'select2/dist/js/select2.full'
import './src/plugins/src/table/datatable/button-ext/dataTables.buttons.min'
import './src/plugins/src/table/datatable/datatables'
import './src/plugins/src/font-icons/feather/feather.min'
import "./src/plugins/src/sweetalerts2/sweetalerts2.min";
import "./src/assets/js/widgets/modules-widgets.js";
//import "./js/collection";

$('.select2').select2({width: '100%', theme: 'bootstrap'})
/**
 * Datatable config
 */
$('#basic').DataTable({
    sDom: "<'dt'<'row'<'col-sm-6 d-flex 'l><'col-12 col-sm-6 d-flex justify-content-sm-end mb-2  'f>>>" +
        "<'table-responsive'tr>" +
        "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count'i><'dt--pagination'p>>",
    "oLanguage": {
        "sSearch": "",
        "oPaginate": {
            "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
            "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
        },
        "sInfo": "Showing page _PAGE_ of _PAGES_",
        "sSearchPlaceholder": "Rechercher...",
        "sProcessing": "Traitement en cours ...",
        "sLengthMenu": "_MENU_",
    },
    responsive: true,
    url: "//cdn.datatables.net/plug-ins/2.2.2/i18n/fr-FR.json",
    buttons: [
        'copy',
        {
            extend: 'excel',
        },
        {
            extend: 'pdf',
            messageBottom: null,
            orientation: 'landscape'
        },
        {
            extend: 'print',
            messageBottom: null,
            title: ''
        }
    ],
    "stripeClasses": [],
    "lengthMenu": [5, 10, 20, 50],
    "pageLength": 5
});

const toastr = require('toastr');
global.toastr = toastr;

import {runInputmask} from "./js/inputmask";
runInputmask();
