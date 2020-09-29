import VueRouter from "vue-router";
import Vue from "vue";
import Login from "./components/auth/Login";
import NotFound from "./components/NotFound";
import Dashboard from "./components/dashboard/Dashboard";
import InfusionsoftLogs from "./components/infusionsoft/InfusionsoftLogs"
import UserProfile from "./components/user/Edit"
import Register from "./components/auth/Register"

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/login',
            name: 'login',
            component: Login,
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
        },
        {
            path: '/',
            name: 'dashboard',
            component: Dashboard,
            meta: {
                layout: 'main'
            }
        },
        {
            path: '/application/:app/logs',
            name: 'applogs',
            component: InfusionsoftLogs,
            meta: {
                layout: 'main'
            }
        },
        {
            path: '/user/profile',
            name: 'profile',
            component: UserProfile,
            meta: {
                layout: 'main'
            }
        },
        {
            path: '*',
            component: NotFound
        }
    ]
});

router.beforeEach((to, from, next) => {

    if (to.name !== 'login' && localStorage.getItem('jwt') == null && to.name !== 'register') {
        next('/login')
    } else {
        next()
    }

});

export default router;
