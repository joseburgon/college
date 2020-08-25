import axios from 'axios';

const Api = axios.create({
    baseURL: '/api',
});

Api.defaults.withCredentials = true;

export default Api;
