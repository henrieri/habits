require('./bootstrap');



const app = new Vue({
    el: '#signup-login'
});

let LoginForm = Vue.component('LoginForm', require('./components/landing/LoginForm.vue'));