import Api from './Api';
import Csrf from './Csrf';
import { update } from 'lodash';

export default {
    async getAll() {
        await Csrf.getCookie();

        return Api.get('/students?page[number]=1&page[size]=25&sort=-id');
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
    },

    async update(id, attributes) {
        await Csrf.getCookie();

        let data = {
            'data': {
                'type': 'students',
                'id': id,
                'attributes': attributes
            }
        }

        return Api.patch(`/students/${id}`, data);
    }
};
