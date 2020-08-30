import Api from './Api';
import Csrf from './Csrf';

export default {
    async getAll() {
        await Csrf.getCookie();

        return Api.get('/transactions');
    },

    async getTransaction(transaction) {
        await Csrf.getCookie();

        return Api.get(`/transactions/${transaction}`);
    }
};
