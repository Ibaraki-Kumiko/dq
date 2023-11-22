/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import { BootstrapVue} from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'


import VueRouter from "vue-router";
import VueCookie from "vue-cookie"

//PrimeVue
import PrimeVue from 'primevue/config';
import ToastService from 'primevue/toastservice';
import 'primevue/resources/primevue.min.css'
import 'primeicons/primeicons.css'
import 'primevue/resources/themes/md-light-indigo/theme.css'


//Algolia Search
import InstantSearch from 'vue-instantsearch'


import router from './router/index'
import index from "./index";
import store from "./store/index";
import {actionTypes as authGetterTypes, getterTypes} from "./store/modules/auth";

//Vuelidate
import Vuelidate from 'vuelidate'

//VueI18n
import VueI18n from 'vue-i18n'
import messages from "./VueI18n/messages";



window.Vue = require('vue').default;

Vue.use(VueRouter);
Vue.use(VueCookie);
Vue.use(Vuelidate)
Vue.use(PrimeVue)
Vue.use(ToastService);
Vue.use(InstantSearch);

Vue.use(BootstrapVue)

Vue.use(VueI18n)

const i18n = new VueI18n({

    //locale: 'de', // установка локализации по умолчанию
    locale: store.state.language, // установка локализации по умолчанию
    messages // установка сообщений локализаций
})


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


//Vue.component('example-component', require('./components/ExampleComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
store.dispatch(authGetterTypes.getCurrentUser).then(() => {
const app = new Vue({
    el: '#app',
    router,
    components: {
        index
    },
    store,
    i18n
});
global.vm = app;

})
