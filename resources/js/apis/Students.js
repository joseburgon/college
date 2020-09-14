import Api from './Api';
import Csrf from './Csrf';
import { update } from 'lodash';

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

        return Api.get('/students', query);
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
    },

    async search(terms, page) {
        await Csrf.getCookie();

        let searchValues = {
            params: {
                'filter[search]': terms,
                'page[number]': page,
                'page[size]': 15,
            }
        }

        return Api.get(`/students`, searchValues);
    }
};
