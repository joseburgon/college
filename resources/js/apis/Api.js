import axios from 'axios';

const Api = axios.create({
    baseURL: '/api/v1',
});

Api.defaults.withCredentials = true;

export default Api;
