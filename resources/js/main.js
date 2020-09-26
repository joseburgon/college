import Vue from "vue";
import router from "./router";
import VueFormulate from "@braid/vue-formulate";
import App from "./App";
import store from '@/store/index'

require("./bootstrap");

Vue.use(VueFormulate);

Vue.config.productionTip = false;

new Vue({
    router,
    store,
    render: h => h(App)
}).$mount("#app");
