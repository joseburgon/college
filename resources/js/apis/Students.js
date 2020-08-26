import Api from './Api';
import Csrf from './Csrf';

export default {
    async getAll() {
        await Csrf.getCookie();

        return Api.get('/students');
    },

    async getStudent(student) {
        await Csrf.getCookie();

        return Api.get(`/students/${student}`);
    }
};
