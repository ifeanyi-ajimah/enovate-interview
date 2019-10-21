/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)


import MyHeader from './components/MyHeader.vue';
Vue.component('myheader', MyHeader);

import AddEmployee from './components/AddEmployee.vue';
Vue.component('addemployee', AddEmployee);



import Company from './components/Company.vue';
Vue.component('company', Company);


// import ShowEmployee from './components/ShowEmployee.vue';
// Vue.component('company', ShowEmployee);




// Vue.component('example-component', require('./components/ExampleComponent.vue').default);


const routes = [

    { path: '/company', component: Company },
    {path: 'addemployee', component : AddEmployee}

  ]

 //creating the router instance
 const router = new VueRouter({
    //mode: 'history',//to remove the # that appears in the link
  routes // short for `routes: routes`
})

const app = new Vue({
    el: '#app',
    router,
});
