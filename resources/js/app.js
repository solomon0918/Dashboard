global.jQuery = require('jquery');
var $ = global.jQuery;
window.$ = $;

require("../../public/js/plugins/@coreui/coreui/dist/css/coreui.min.css");

require("../../public/js/plugins/jquery/dist/jquery.min.js");
require("../../public/js/plugins/popper.js/dist/umd/popper.min.js");
require("../../node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js");
require("../../public/js/plugins/@coreui/coreui/dist/js/coreui.min.js");

require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import {routes} from './helpers/routes';
import MainApp from './components/MainApp.vue';
import StoreData from './store';
import Axios from 'axios';
import {initialize} from './helpers/init';

Vue.use(VueRouter);
Vue.use(Vuex);

const store = new Vuex.Store(StoreData);

const router = new VueRouter({
    routes,
    mode: 'history'
});

initialize(router, store);

const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        MainApp
    }
});
