import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '../views/HoveView.vue';

const routes = [
    {
        path: '/',
        component: HomeView
    },

];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;