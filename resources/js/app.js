import Vue from "vue";
import router from "./router";
import VueFormulate from "@braid/vue-formulate";
import { firestorePlugin } from "vuefire";
import App from "./components/App";

require("./bootstrap");
Vue.use(VueFormulate);
Vue.use(firestorePlugin);

Vue.config.productionTip = false;

new Vue({
    router,
    render: h => h(App)
}).$mount("#app");
