/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';

Vue.use(VueRouter)
import Index from './components/Index'
import App from './components/App'
import Edit from './components/Edit'
import Add from './components/Add'
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: require('./components/App.vue').default,
        },
        {
            path: '/edit/:id',
            name: 'edit',
            component: require('./components/Edit.vue').default,
        },
        {
            path: '/create',
            name: 'create',
            component: require('./components/Add.vue').default,
        },
    ],
});
Vue.component('app', require('./components/App.vue').default);
Vue.component('add', require('./components/Add.vue').default);
Vue.component('edit', require('./components/Edit.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
  components: { App },
}).$mount('#app')
