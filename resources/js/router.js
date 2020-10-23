import Vue from 'vue';
import VueRouter from 'vue-router';
import Register from './views/Register';
import Unavailable from './views/Unavailable';
import Response from './views/Response';
import Success from './views/Success';
import Failure from './views/Failure';
import Pending from './views/Pending';
import Error from './views/Error';
import Login from './views/dashboard/Login';
import Dashboard from './views/dashboard/Dashboard';
import StudentsIndex from './views/dashboard/students/Index';
import StudentsEdit from './views/dashboard/students/Edit';
import TransactionsIndex from './views/dashboard/transactions/Index';
import ReferenceIndex from './views/dashboard/references/Index';
import ReferenceShow from './views/dashboard/references/Show';
import Exports from './views/dashboard/Exports';

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
        path: '/unavailable',
        name: 'unavailable',
        component: Unavailable,
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
        path: '/dashboard/students',
        name: 'students',
        component: StudentsIndex,
        meta: { authOnly: true },
    },
    {
        path: '/dashboard/students/:id/edit',
        name: 'students-edit',
        component: StudentsEdit,
        meta: { authOnly: true },
    },
    {
        path: '/dashboard/transactions',
        name: 'transactions',
        component: TransactionsIndex,
        meta: { authOnly: true },
    },
    {
        path: '/dashboard/references',
        name: 'references',
        component: ReferenceIndex,
        meta: { authOnly: true },
    },
    {
        path: '/dashboard/references/:id/show',
        name: 'references-show',
        component: ReferenceShow,
        meta: { authOnly: true },
    },
    {
        path: '/dashboard/exports',
        name: 'exports',
        component: Exports,
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
