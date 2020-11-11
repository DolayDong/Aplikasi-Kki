/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');

window.Vue = require('vue');

Pusher.logToConsole = true;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('login-component', require('./components/LoginComponent.vue').default);
Vue.component('modal-daftar', require('./components/ModalDaftar.vue').default);
Vue.component('home-kiri-component', require('./components/HomeKiriComponent.vue').default);
Vue.component('postingan-component', require('./components/PostinganComponent.vue').default);
Vue.component('home-kanan-component', require('./components/HomeKananComponent.vue').default);
Vue.component('modal-add-photo', require('./components/ModalAddPhoto.vue').default);
Vue.component('commentar-component', require('./components/CommentarComponent.vue').default);
Vue.component('button-add-teman', require('./components/ButtonAddTeman.vue').default);
Vue.component('component-kiri-pesan', require('./components/ComponentKiriPesan.vue').default);
Vue.component('like-komponent', require('./components/LikeComponent.vue').default);
Vue.component('pesan-component', require('./components/PesanComponent.vue').default);
Vue.component('modal-preview-gambar-pesan', require('./components/PreviewGambarPesanModal.vue').default);
Vue.component('call-component', require('./components/CallComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */



const app = new Vue({
    el: '#app',
});

const modal = new Vue({
    el: '#modal',
});

const homekiri = new Vue({
    el: "#home-kiri"
});
const homekanan = new Vue({
    el: "#home-kanan"
});
const hometengah = new Vue({
    el: "#home-tengah"
});
const modaladdphoto = new Vue({
    el: "#modal-add-photo"
});
const commentarcomponent = new Vue({
    el: "#content"
});

