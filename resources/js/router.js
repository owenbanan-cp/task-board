import { checkAuthentication } from './middleware'
import VueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(VueRouter);

const router = new VueRouter({
    routes: [
        {
            path: '/login',
            name: 'Login',
            component: () => import('./components/Pages/Login.vue'),
            meta: {
                guest: true
            }
        },
        {
            path: '/',
            name: 'Home',
            component: () => import('./components/Pages/Home.vue'),
            meta: {
                auth: true
            }
        }
    ]
})

router.beforeEach(checkAuthentication)

export default router;

