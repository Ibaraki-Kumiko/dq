import axios from "./axios";

const feedback = async (credentials) => {
    return axios.post('/feedback', credentials)
}



export default {
    feedback,
}
