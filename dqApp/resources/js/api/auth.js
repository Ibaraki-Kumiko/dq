import axios from "./axios";

const register = async (credentials) => {
    return axios.post('/register', credentials)
}

const login = async (credentials) => {
    return await axios.post('/login', credentials)
}

const getCurrentUser = async () => {
    return await axios.get('/user')
}


const logout = async () => {
    return axios.post("/logout");
}

export default {
    register,
    login,
    getCurrentUser,
    logout,
}
