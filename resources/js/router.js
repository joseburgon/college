import Vue from "vue";
import Router from "vue-router";
import Register from "./views/Register";
import Response from "./views/Response";
import Error from "./views/Error";
import Testing from "./views/Testing";

Vue.use(Router);

export default new Router({
    mode: "history",

    routes: [
        {
            path: "/",
            redirect: "/register"
        },
        {
            path: "/register",
            name: "register",
            component: Register
        },
        {
            path: "/testing",
            name: "testing",
            component: Testing
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
