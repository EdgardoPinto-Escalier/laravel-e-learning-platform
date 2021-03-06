/*jshint esversion: 6 */

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit servertableyour unique needs.
 */

import { ServerTable } from 'vue-tables-2';
Vue.use(ServerTable, {}, false, 'bootstrap4', 'default');

//VUE HTTP RESOURCE
import VueResource from 'vue-resource';
Vue.use(VueResource);

//.VUE HTTP RESOURCE

import StripeForm from './components/StripeForm';
Vue.component('stripe-form', StripeForm);

import Courses from './components/Courses';
Vue.component('courses-list', Courses);

const app = new Vue({
    el: '#app',
  });
