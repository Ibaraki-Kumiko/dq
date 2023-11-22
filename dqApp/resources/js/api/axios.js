import axios from "axios";
import router from '../router/index';


axios.defaults.baseURL = '/api'


axios.interceptors.response.use(
    response => {
        return response;
    },
    error => {
        if (error.response && error.response.status === 404) {
            router.push('/not-found');
        }
        return Promise.reject(error);
    }
);



export default axios;
