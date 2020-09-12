import Vue from "vue";
import router from "./router";
import VueFormulate from "@braid/vue-formulate";
import App from "./App";

require("./bootstrap");
Vue.use(VueFormulate);

Vue.config.productionTip = false;

new Vue({
    router,
    render: h => h(App)
}).$mount("#app");
