
require('./bootstrap');


import Vue from 'vue'
import store from './store'
import router from "./router";
import App from "./components/App";
import Toasted from 'vue-toasted';


import currencyFilter from "./filters/currencyFilter";
import dateFilter from "./filters/dateFilter";



import 'materialize-css/extras/noUiSlider/nouislider.css'
import 'materialize-css/dist/js/materialize.min'
import "materialize-css/dist/css/materialize.min.css";

Vue.filter('dateFilter', dateFilter)
Vue.filter('currencyFilter', currencyFilter)

Vue.use(Toasted, {
    theme: "toasted-primary",
    position: "top-right",
    duration : 4000,
});


const app = new Vue({
    el: '#app',
    store,
    router,
    components: {
        App
    }
});
