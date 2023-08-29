import feedbackApi from "../../api/contacts"

const state = {
    isSubmitting: false,
    isLoading: false,
    validationErrors: null,
}

export const mutationTypes = {
    feedbackStart: '[feedback] feedbackStart',
    feedbackSuccess: '[feedback] feedbackSuccess',
    feedbackFailure: '[feedback] feedbackFailure',


}

export const actionTypes = {
    feedback: 'feedback',

}

export const getterTypes = {

}

const getters = {

}

const mutations = {
    [mutationTypes.feedbackStart](state) {
        state.isSubmitting = true
        state.validationErrors = null
    },
    [mutationTypes.feedbackSuccess](state, payload) {
        state.isSubmitting = false

    },
    [mutationTypes.feedbackFailure](state, payload) {
        state.isSubmitting = false
        state.validationErrors = payload
    },

}

const actions = {
    [actionTypes.feedback](context, credentials) {
        return new Promise((resolve, reject) => {
            context.commit(mutationTypes.feedbackStart)
            feedbackApi.feedback(credentials)
                .then(response => {
                    context.commit(mutationTypes.feedbackSuccess, response.data)
                    resolve(response.data)
                }).catch(error => {
                    if(error.response.status === 422) {
                        context.commit(  mutationTypes.feedbackFailure, error.response.data.errors)
                    }
                if(error.response.status === 500) {
                    reject(new Error("Internal Server Error"))
                }



            })
        })
    },


}

export default {
    state,
    mutations,
    actions,
    getters
}

