require('./bootstrap');

window.Vue = require('vue');
import FullCalendar from 'vue-full-calendar'

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.use(FullCalendar)

const app = new Vue({
    el: '#app'
});

