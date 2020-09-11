import Api from './Api';
import Csrf from './Csrf';

export default {
    async getAll() {
        await Csrf.getCookie();

        return Api.get('/reference-codes?page[number]=1&page[size]=25&sort=id');
    },

    async getReference(reference) {
        await Csrf.getCookie();

        return Api.get(`/reference-codes/${reference}`);
    },

    async create(info) {
        await Csrf.getCookie();

        let data = {
            'data': {
                'type': 'reference-codes',
                'attributes': info
            }
        }

        return Api.post(`/reference-codes`, data);
    }
};