import Vue from 'vue'
import VueRouter from 'vue-router'
import * as auth from '../helpers/http_service';

Vue.use(VueRouter);

const routes = [

    {
        path: '/',
        component: () => import('../components/MainWrapper.vue'),

        children: [
            {
                path: '/',
                name: 'MainPage',
                component: () => import('../components/Pages/MainPage/MainPage.vue'),
            },
            {
                path: '/about',
                name: 'AboutUs',
                component: () => import('../components/Pages/AboutAs/AboutUs.vue'),
            },

            {
                path: '/contact',
                name: 'ContactUs',
                component: () => import('../components/Pages/ContactUs/ContactUs.vue'),
            },
            {
                path: '/cart',
                name: 'Cart',
                component: () => import('../components/Pages/Cart/Cart.vue'),
            },
            {
                path: '/order',
                name: 'Order',
                component: () => import('../components/Pages/OrderConfirm/OrderConfirm.vue'),
            },
            {
                path: '/order-complete',
                name: 'OrderComplete',
                component: () => import('../components/Pages/OrderConfirm/OrderComplete.vue'),
            },
            {
                path: '/one-product/:id',
                name: 'OneProduct',
                component: () => import('../components/Pages/OneProduct/OneProduct.vue'),
                props: true
            },
            {
                path: '/tree',
                name: 'OneProduct',
                component: () => import('../components/Pages/Tree/Tree.vue'),
                props: true
            },

        ]
    },


    {
        path: '/admin',
        component: () => import('../components/admin/AdminMain.vue'),

        children: [
            {
                path: 'profile',
                name: 'Dashboard',
                component: () => import('../components/admin/Users/Profile.vue'),
            },
            {
                path: '/',
                name: 'Orders',
                component: () => import('../components/admin/Orders/Orders.vue'),
            },
            {
                path: 'categories',
                name: 'Categories',
                component: () => import('../components/admin/Categories/Categories.vue'),
            },
            {
                path: 'products',
                name: 'Products',
                component: () => import('../components/admin/Products/Products.vue'),
            },
            {
                path: 'users',
                name: 'Users',
                component: () => import('../components/admin/Users/Users.vue'),
            },
            {
                path: 'comments',
                name: 'Comments',
                component: () => import('../components/admin/Comments/Comments.vue'),
            },
        ],
        beforeEnter(to, from, next) {
            if(! auth.isLoggedIn()){
                next('/login')
            }
            else if(auth.getUserRole() !== 'admin') {
                next('/404')
            }
            else {
                next()
            }

        }
    },

    {
        path: '/person',
        component: () => import('../components/person/Person.vue'),
        children: [

            {
                path: '/',
                name: 'OrdersUser',
                component: () => import('../components/person/Orders/Orders.vue'),
            },
            {
                path: 'profile',
                name: 'ProfileUser',
                component: () => import('../components/person/Profile/ProfileUser.vue'),
            },
        ],
        beforeEnter(to, from, next) {
            if(! auth.isLoggedIn() && auth.getUserRole() !== 'user'){
                next('/login')
            }
            else if (auth.getUserRole() !== 'user') {
                next('/404')
            } else {
                next()
            }
        }

    },


    {
        path: '*',
        name: '404',
        component:  () => import('../components/errors/404.vue'),
    },

    {
        path: '/login',
        name: 'Login',
        component: () => import('../components/auth/Login.vue'),

    },

    {
        path: '/register',
        name: 'Register',
        component: () => import('../components/auth/Register.vue'),
    },
    {
        path: '/reset-password/:email',
        name: 'ResetPassword',
        component: () => import('../components/auth/ResetPassword.vue'),
        beforeEnter(to, from, next){
            if (!auth.isLoggedIn()){
                next()
            }else {
                next('/')
            }
        }
    },

    {
        path: '/reset-password-request',
        name: 'ResetPasswordRequest',
        component: () => import('../components/auth/ResetPasswordRequest.vue'),
        beforeEnter(to, from, next){
            if (!auth.isLoggedIn()){
                next()
            }else {
                next('/')
            }
        }
    },



];

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes,
    linkActiveClass: 'active'
});

export default router
