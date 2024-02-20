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
        loading: false,
        language: 'de'
    },
    mutations: {
        setLoading(state, payload) {
            state.loading = payload;
        },
        setLanguage(state, language) {
            state.language = language;
        }

    },
    /*getters: {
        currentLanguage: state => state.language,
        sidebar: state => state.app.sidebar,
        device: state => state.app.device,
        token: state => state.user.token,
        avatar: state => state.user.avatar,
        name: state => state.user.name
    },*/
    actions: {
        changeLanguage({ commit }, language) {
            commit('setLanguage', language);
        }
    },
    modules: {
        auth,
        contacts,
        toast,



    }
})
