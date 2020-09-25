import Api from './Api';
import Csrf from './Csrf';

export default {
    async get() {
        await Csrf.getCookie();

        let query = {
            params: {
                'page[number]': 1,
                'page[size]': 15,
                'sort': '-id',
            }
        }

        return Api.get('/transactions', query);
    },

    async getTransaction(transaction) {
        await Csrf.getCookie();

        return Api.get(`/transactions/${transaction}`);
    },

    async search(terms, page) {
        await Csrf.getCookie();

        let searchValues = {
            params: {
                'filter[search]': terms,
                'page[number]': page,
                'page[size]': 15,
                'sort': '-id',
            }
        }

        return Api.get(`/transactions`, searchValues);
    }
};
