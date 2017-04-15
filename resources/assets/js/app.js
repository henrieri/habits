
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import router from './routes';
import Vue2Filters from 'vue2-filters'

Vue.use(Vue2Filters);

Vue.component('toast', require('./components/Toast'));

const app = new Vue({
    el: '#app',
    router
});
