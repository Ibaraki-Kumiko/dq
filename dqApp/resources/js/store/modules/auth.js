import authApi from "../../api/auth"

const state = {
    isSubmitting: false,
    isLoading: false,
    currentUser: null,
    validationErrors: null,
    isLoggedIn: false,
}

export const mutationTypes = {
    registerStart: '[auth] registerStart',
    registerSuccess: '[auth] registerSuccess',
    registerFailure: '[auth] registerFailure',

    loginStart: '[auth] loginStart',
    loginSuccess: '[auth] loginSuccess',
    loginFailure: '[auth] loginFailure',

    getCurrentUserStart: '[auth] getCurrentUserStart',
    getCurrentUserSuccess: '[auth] getCurrentUserSuccess',
    getCurrentUserFailure: '[auth] getCurrentUserFailure',

    updateCurrentUserStart: '[auth] updateCurrentUserStart',
    updateCurrentUserSuccess: '[auth] updateCurrentUserSuccess',
    updateCurrentUserFailure: '[auth] updateCurrentUserFailure',

    logout: '[auth] logout'
}

export const actionTypes = {
    register: '[auth] register',
    login: '[auth] login',
    getCurrentUser: '[auth] getCurrentUser',
    updateCurrentUser: '[auth] updateCurrentUser',
    logout: '[auth] logout'
}

export const getterTypes = {
    currentUser: '[auth] currentUser',
    isLoggedIn: '[auth] isLoggedIn',
    isAnonymous: '[auth] isAnonymous',
    isAdmin: 'isAdmin',
}

const getters = {
    [getterTypes.currentUser]: state => { //local state
        return state.currentUser
    },
    [getterTypes.isLoggedIn]: state => {
        return Boolean(state.isLoggedIn)
    },
    [getterTypes.isAnonymous]: state => {
        return state.isLoggedIn === false
    },
    [getterTypes.isAdmin]: state => {
        return state.currentUser ? Boolean(state.currentUser.is_admin) : false
    }
}

const mutations = {
    [mutationTypes.registerStart](state) {
        state.isSubmitting = true
        state.validationErrors = null
    },
    [mutationTypes.registerSuccess](state, payload) {
        state.isSubmitting = false
        state.currentUser = payload
        state.isLoggedIn = true
    },
    [mutationTypes.registerFailure](state, payload) {
        state.isSubmitting = false
        state.validationErrors = payload
    },
    [mutationTypes.loginStart](state) {
        state.isSubmitting = true
        state.validationErrors = null
    },
    [mutationTypes.loginSuccess](state, payload) {
        state.isSubmitting = false
        state.currentUser = payload.user
        state.isLoggedIn = true
    },
    [mutationTypes.loginFailure](state, payload) {
        state.isSubmitting = false
        state.validationErrors = payload
    },

    [mutationTypes.getCurrentUserStart](state) {
        state.isLoading = true
    },
    [mutationTypes.getCurrentUserSuccess](state, payload) {
        state.isLoading = false
        state.currentUser = payload
        state.isLoggedIn = true
    },
    [mutationTypes.getCurrentUserFailure](state) {
        state.isLoading = false
        state.isLoggedIn = false
        state.currentUser = null

    },

    [mutationTypes.updateCurrentUserStart]() {

    },
    [mutationTypes.updateCurrentUserSuccess](stare, payload) {
        state.currentUser = payload
    },
    [mutationTypes.updateCurrentUserFailure]() {

    },
    [mutationTypes.logout]() {
        state.currentUser = null
        state.isLoggedIn = false
    }
}

const actions = {
    [actionTypes.register](context, credentials) {
        return new Promise(resolve => {
            context.commit(mutationTypes.registerStart)
            authApi.register(credentials)
                .then(response => {
                    context.commit(mutationTypes.registerSuccess, response.data)
                    window.localStorage.setItem('isLoggedIn', true)
                    Vue.cookie.set('token', response.data.token, 1);
                    resolve(response.data)
                }).catch(result => {
                context.commit(  mutationTypes.registerFailure,
                    result.response.data.errors)
            })
        })
    },
    [actionTypes.login](context, credentials) {
        return new Promise(resolve => {
            context.commit(mutationTypes.loginStart)
            authApi.login(credentials)
                .then(response => {
                    context.commit(mutationTypes.loginSuccess, response.data)
                    window.localStorage.setItem('isLoggedIn', true)
                    Vue.cookie.set('token', response.data.token, 1);
                    resolve(response.data.user)
                }).catch(result => {
                context.commit(mutationTypes.loginFailure, result.response.data.errors)
            })
        })
    },
    [actionTypes.getCurrentUser](context) {
        return new Promise(resolve => {
            context.commit(mutationTypes.getCurrentUserStart)
            authApi.getCurrentUser()
                .then(response => {
                    context.commit(mutationTypes.getCurrentUserSuccess, response.data)

                    resolve(response.data.user)
                }).catch(() => {
                console.log('ERROR CurrentUser!! ')
                context.commit(mutationTypes.getCurrentUserFailure)
                resolve()
            })
        })
    },

    [actionTypes.updateCurrentUser](context, {currentUserInput}) {
        return new Promise(resolve => {
            context.commit(mutationTypes.updateCurrentUserStart)
            authApi
                .updateCurrentUser(currentUserInput)
                .then(()=> {
                    context.commit(mutationTypes.logoutSuccess, user)
                    resolve(user)
                }).catch((result) => {
                context.commit(mutationTypes.updateCurrentUserFailure,
                    result.response.data.errors
                )
            })
        })
    },

    [actionTypes.logout](context) {
        return new Promise(resolve => {
            context.commit(mutationTypes.logout)
            authApi
                .logout()
                .then(() =>  {
                        Vue.cookie.delete('token');
                        window.localStorage.setItem('isLoggedIn', false)
                        resolve()
                    }

                )

        })
    }
}

export default {
    state,
    mutations,
    actions,
    getters
}

