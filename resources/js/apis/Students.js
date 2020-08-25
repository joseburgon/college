import Api from './Api';
import Csrf from './Csrf';

export default {
    async get() {
        await Csrf.getCookie();

        return Api.get('/students');
    }
}
