import {createRouter, createWebHistory} from "vue-router";

import store from './store/user';
import Login from './page/Login';
import Nav from './page/Nav';

import ReportList from "./components/report/ReportList";
import EditReport from "./components/report/EditReport";

import Users from "./components/user/Users";
import EditUser from "./components/user/EditUser";

const route_list = [
    {
        path:'/',
        components: {
            default: Login,
        },
        name: 'index',
        meta: {
            title: 'index'
        }
    },
    {
        path:'/report',
        components: {
            default: ReportList,
            Nav: Nav
        },
        name: 'Report',
        meta: {
            title: 'Report'
        }
    },
    {
        path:'/report/newreport',
        components: {
            default: EditReport,
            Nav: Nav
        },
        name: 'NewReport',
        meta: {
            title: 'Report'
        }
    },
    {
        path:'/report/:id',
        components: {
            default: EditReport,
            Nav: Nav
        },
        name: 'EditReport',
        meta: {
            title: 'Report'
        }
    },
    {
        path:'/user',
        components: {
            default: Users,
            Nav: Nav
        },
        name: 'Users',
        meta: {
            title: 'Users'
        }
    },
    {
        path:'/user/newuser',
        components: {
            default: EditUser,
            Nav: Nav
        },
        name: 'NewUser',
        meta: {
            title: 'NewUser'
        }
    },
    {
        path:'/user/:id',
        components: {
            default: EditUser,
            Nav: Nav
        },
        name: 'EditUser',
        meta: {
            title: 'EditUser'
        }
    },

]

const router = createRouter({
        history: createWebHistory(),
        routes: route_list,
    }
)
router.beforeEach((to, from, next)=>{

    if(!store.state.isAdmin && store.state.isLogin && to.path == '/user') next('/report')
    if(!store.state.isLogin && to.path != '/')
    {
        next('/');
    }
    next();
})

export default router
