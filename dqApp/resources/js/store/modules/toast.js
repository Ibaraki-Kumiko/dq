const state = {
    toastMessage: null,
}

const mutations = {
    updateToastMessage(state, message) {
        state.toastMessage = message;
    },
}


export default {
    state,
    mutations,
}

