import Api from './Api';
import Csrf from './Csrf';

export default {
    async getAll() {
        await Csrf.getCookie();

        return Api.get('/students?page[number]=1&page[size]=25&sort=id');
    },

    async getStudent(student) {
        await Csrf.getCookie();

        return Api.get(`/students/${student}`);
    },

    async create(student) {
        await Csrf.getCookie();

        let data = {
            'data': {
                'type': 'students',
                'attributes': student
            }
        }

        return Api.post(`/students`, data);
    }
};
