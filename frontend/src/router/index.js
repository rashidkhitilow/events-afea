import { createRouter, createWebHistory } from 'vue-router';
import EventList from '@/components/EventList.vue';
import EventDetail from '@/components/EventDetail.vue';

const routes = [
    {
        path: '/',
        name: 'EventList',
        component: EventList,
    },
    {
        path: '/events/:id',
        name: 'EventDetail',
        component: EventDetail,
        props: true,
        beforeEnter: (to, from, next) => {
            console.log('Navigating to EventDetail with ID:', to.params.id);
            next();
        },
    },
    {
        path: '/:catchAll(.*)',
        redirect: '/',
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
