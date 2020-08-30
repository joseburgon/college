import Vue from 'vue';
import VueRouter from 'vue-router';
import Register from './views/Register';
import Response from './views/Response';
import Success from './views/Success';
import Failure from './views/Failure';
import Pending from './views/Pending';
import Error from './views/Error';
import Login from './views/dashboard/Login';
import Dashboard from './views/dashboard/Dashboard';
import StudentEdit from './views/dashboard/students/Edit';
import TransactionsIndex from './views/dashboard/transactions/Index';

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        redirect: '/register',
        meta: { guestOnly: true },
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: { guestOnly: true },
    },
    {
        path: '/response',
        name: 'response',
        component: Response,
        meta: { guestOnly: true },
    },
    {
        path: '/success',
        name: 'success',
        component: Success,
        meta: { guestOnly: true },
    },
    {
        path: '/failure',
        name: 'failure',
        component: Failure,
        meta: { guestOnly: true },
    },
    {
        path: '/pending',
        name: 'pending',
        component: Pending,
        meta: { guestOnly: true },
    },
    {
        path: '/login',
        name: 'Login',
        component: Login,
        meta: { guestOnly: true },
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        meta: { authOnly: true },
    },
    {
        path: '/dashboard/student/:id/edit',
        name: 'student-edit',
        component: StudentEdit,
        meta: { authOnly: true },
    },
    {
        path: '/dashboard/transactions',
        name: 'transactions',
        component: TransactionsIndex,
        meta: { authOnly: true },
    },
    {
        path: '*',
        name: 'error',
        component: Error,
        meta: { guestOnly: true },
    },
];

const router = new VueRouter({
    mode: 'history',
    routes,
});

function isLoggedIn() {
    return localStorage.getItem('auth');
}

router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.authOnly)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!isLoggedIn()) {
            next({
                path: '/',
                query: { redirect: to.fullPath },
            });
        } else {
            next();
        }
    } else if (to.matched.some((record) => record.meta.guestOnly)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (isLoggedIn()) {
            next({
                path: '/dashboard',
                query: { redirect: to.fullPath },
            });
        } else {
            next();
        }
    } else {
        next(); // make sure to always call next()!
    }
});

export default router;
