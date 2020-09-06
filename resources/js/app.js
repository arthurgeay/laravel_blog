import route from 'ziggy';
import { Ziggy } from './ziggy';

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.mixin({
    methods: {
        route: (name, params, absolute) => route(name, params, absolute, Ziggy)
    }
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/PostList.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


Vue.component('post-list', require('./components/PostList').default);
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('post', require('./components/Post').default);
Vue.component('post-form', require('./components/PostForm').default);
Vue.component('dashboard', require('./components/Dashboard').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/* Global filter for format date */
Vue.filter('formatDate', function(value, withTime = false) {
    if(withTime) {
        return new Date(value).toLocaleString();
    }

    return new Date(value).toLocaleDateString();
});

const app = new Vue({
    el: '#app'
});
