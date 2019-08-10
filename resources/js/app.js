
//==============================================================================================================
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

    require('./bootstrap');

    // global.$ = global.jQuery = require('jquery');
    
    // require('admin-lte/plugins/jquery/jquery.min.js');
    require('admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js');
    require('admin-lte/plugins/select2/js/select2.full.min.js');

    
    require('moment');
    //Bootstrap datepicker 1.9.0
    require('bootstrap-datepicker');

    //daterangePicker 3.0.5
    // require('admin-lte/plugins/daterangepicker/daterangepicker');

    
    require('admin-lte/plugins/datatables/jquery.dataTables.js');
    require('admin-lte/plugins/datatables/dataTables.bootstrap4.js');


    // Summernote 0.8.12
    require('admin-lte/plugins/summernote/summernote-bs4.min.js');
    // Jasnybootstrap 4.0.0
    require('jasny-bootstrap/dist/js/jasny-bootstrap');


    require('admin-lte/plugins/fastclick/fastclick.js');
    require('admin-lte/dist/js/adminlte.min.js');
    require('admin-lte/dist/js/demo.js');

  

    require('./custom');

    

    
    


window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
