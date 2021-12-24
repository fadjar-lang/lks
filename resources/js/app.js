try {
    require('bootstrap');
} catch (e) {}


import Vue from 'vue';
import jQuery from 'jquery';
global.jQuery = jQuery;
global.$ = jQuery;

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('navigation', require('./components/Navigation.vue').default);

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import Toasted from 'vue-toasted';
Vue.use(Toasted);

import Barang from './admin/barang/Barang.vue';
import AddBarang from './admin/barang/Tambah.vue';
import EditBarang from './admin/barang/Edit.vue';
import HapusBarang from './admin/barang/Hapus.vue';
import Detail from './admin/barang/Detail.vue';
import Login from './admin/auth/Login.vue';
import Home from './home/index.vue';
import DetailHome from './home/Detail.vue';
import Cart from './home/Cart.vue';

const routes = [
	{
		path: '/',
		name: 'home',
		component: Home
	},
	{
		path: '/detail/:id',
		name: 'detailhome',
		component: DetailHome
	},
	{
		path: '/login',
		name: 'login',
		component: Login
	},
  {
		path: '/barang',
		name: 'barang',
		component: Barang
	},
	{
		path: '/barang/tambah',
		name: 'addbarang',
		component: AddBarang
	},
	{
		path: '/barang/edit/:id',
		name: 'editbarang',
		component: EditBarang
	},
	{
		path: '/barang/hapus/:id',
		name: 'hspusbarang',
		component: HapusBarang
	},	
	{
		path: '/barang/detail/:id',
		name: 'detailbarang',
		component: Detail
	},
	{
		path: '/pesanan/detail',
		name: 'cart',
		component: Cart
	},

];

let router = new VueRouter({
	mode: 'history',
	routes
});

const app = new Vue({
    el: '#app',
		router
});
