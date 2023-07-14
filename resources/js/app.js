import clickOutside from "./directives/click-outside";
import App from './components/App.vue';
import store from "./store/store";
import router from "./router";
import Vue from "vue";
require('./bootstrap');

Vue.use(clickOutside);

/** Global Components */
Vue.component('top-navigation', require('./components/Globals/TopNavigation.vue').default)
Vue.component('success-notification', require('./components/Globals/Notifications/Success.vue').default)

/** Universal Components */
Vue.component('modal', require('./components/Universals/Modal.vue').default)

new Vue({
    store: store,
    render: (h) => h(App),
    router
}).$mount('#app')

