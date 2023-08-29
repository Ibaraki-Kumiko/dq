import Vue from 'vue'
import Vuex from 'vuex'
import VueCookies from 'vue-cookies'
import VueCookie from "vue-cookie"
import auth from "./modules/auth"
import contacts from "./modules/contacts"
import toast from "./modules/toast"


Vue.use(Vuex, VueCookies, VueCookie)

export default new Vuex.Store({
    state: {
    },
    mutations: {


    },
    getters: {

    },
    actions: {
    },
    modules: {
        auth,
        contacts,
        toast

    }
})
