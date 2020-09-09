import Api from './Api';
import Csrf from './Csrf';

export default {
    async getAll() {
        await Csrf.getCookie();

        return Api.get('/transactions?page[number]=1&page[size]=25&sort=-id');
    },

    async getTransaction(transaction) {
        await Csrf.getCookie();

        return Api.get(`/transactions/${transaction}`);
    }
};
