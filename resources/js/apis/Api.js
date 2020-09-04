import axios from 'axios';

const Api = axios.create({
    baseURL: '/',
});

Api.defaults.withCredentials = true;

export default Api;
