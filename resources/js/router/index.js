import {createWebHistory, createRouter} from "vue-router";

import Home from './../pages/Home';
import Register from './../pages/Register';
import Login from './../pages/Login';
import Dashboard from './../pages/Dashboard';
import Users from './../pages/Users';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard
    },
    {
        name: 'users',
        path: '/users',
        component: Users
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
