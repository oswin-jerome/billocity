/*
 *   Copyright (c) 2020 
 *   All rights reserved.
 */
// require('./bootstrap');


import Vue from 'vue'
window.Vue = Vue;
window.bus = new Vue;
import App from './Vue/app'

const app = new Vue({
    el:'#posApp',
    components:{App}
})







