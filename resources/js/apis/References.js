import Api from './Api';
import Csrf from './Csrf';

export default {
    async get() {
        await Csrf.getCookie();

        let query = {
            params: {
                'page[number]': 1,
                'page[size]': 15,
                'sort': '-created_at',
            }
        }

        return Api.get('/reference-codes', query);
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
    },

    async search(terms, page) {
        await Csrf.getCookie();

        let searchValues = {
            params: {
                'filter[search]': terms,
                'page[number]': page,
                'page[size]': 15,
                'sort': '-created_at',
            }
        }

        return Api.get(`/reference-codes`, searchValues);
    }
};
