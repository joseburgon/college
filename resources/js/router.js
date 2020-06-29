import Vue from "vue";
import Router from "vue-router";
import Register from "./views/Register";
import Confirmation from "./views/Confirmation";
import Response from "./views/Response";
import Error from "./views/Error";
import Start from "./views/Start";

Vue.use(Router);

export default new Router({
    mode: "history",

    routes: [
        {
            path: "/",
            name: "start",
            component: Start
        },
        {
            path: "/register",
            name: "register",
            component: Register
        },
        {
            path: "/confirmation",
            name: "confirmation",
            component: Confirmation
        },
        {
            path: "/response",
            name: "response",
            component: Response
        },
        {
            path: "*",
            name: "error",
            component: Error
        }
    ]
});
