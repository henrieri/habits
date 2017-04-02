import VueRouter from 'vue-router';

let routes = [
    {
        path: '/',
        component: require('./views/Dashboard')
    },
    {
        path: '/today',
        component: require('./views/Today')
    },
    {
        path: '/progress',
        component: require('./views/Progress')
    },
    {
        path: '/habits',
        component: require('./views/Habits')
    },
    {
        path: '/history',
        component: require('./views/History')
    }

];

export default new VueRouter({
    routes,
    linkActiveClass: 'is-active'
});