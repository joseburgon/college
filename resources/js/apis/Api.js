import axios from 'axios';

const Api = axios.create({
    baseURL: '/api/v1',
    headers: {
        'Content-Type': 'application/vnd.api+json',
        'Accept': 'application/vnd.api+json'
    }
});

Api.defaults.withCredentials = true;

export default Api;
