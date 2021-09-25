import {createWebHistory, createRouter} from "vue-router";

import Home from './../pages/Home';
import Register from './../pages/Register';
import Login from './../pages/Login';
import Dashboard from './../pages/Dashboard';
import Users from './../pages/Users';
import Create from "../pages/cards/create";
import Edit from "../pages/cards/edit";
import Received from "../pages/cards/received";
import Sent from "../pages/cards/Sent";

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
    {
        name: 'create',
        path: "/create",
        component: Create
    },
    {
        name: 'edit',
        path: "/edit/:id",
        component: Edit
    },
    {
        name: 'received',
        path: "/received",
        component: Received
    },
    {
        name: 'sent',
        path: "/sent",
        component: Sent
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
