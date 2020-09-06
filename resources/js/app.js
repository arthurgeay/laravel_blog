/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/PostList.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import PostList from './components/PostList.vue';
import Post from './components/Post.vue';
import PostForm from './components/PostForm.vue';
import Dashboard from './components/Dashboard.vue';

Vue.component('post-list', PostList);
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('post', Post);
Vue.component('post-form', PostForm);
Vue.component('dashboard', Dashboard);

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
