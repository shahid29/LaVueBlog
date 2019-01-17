
require('./bootstrap');


// vue router
window.Vue = require('vue');
import VueRouter from 'vue-router'
Vue.use(VueRouter);


//routes
import {routes} from './routes';
const router = new VueRouter({
    routes, // short for `routes: routes`
    mode:'hash',
    base:'home'

});

//v-form
import { Form, HasError, AlertError } from 'vform'
window.Form= Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)


//sweet alert2
import Swal from 'sweetalert2';
window.Swal = Swal;
const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
window.toast = toast;


//vuex
import Vuex from 'vuex'
Vue.use(Vuex)
import storeData from './store/index'
const store = new Vuex.Store(
        storeData
    );


//Date Time Format using Moment js
import {filter} from './filter'

//Vue Editor
import 'v-markdown-editor/dist/index.css';
import Editor from 'v-markdown-editor'
Vue.use(Editor);


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('admin-main', require('./components/admin/AdminMaster.vue').default);
Vue.component('public-main', require('./components/public/PublicMaster').default);

const app = new Vue({
    el: '#app',
    router,
    store,

});
