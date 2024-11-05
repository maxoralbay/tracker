import Vue from "vue";
import App from "./App.vue";
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Import Bootstrap and BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import './assets/app.scss'
import axios from "axios";
// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

Vue.config.productionTip = false;
axios.interceptors.response.use(
    (response) => response,
    (error) => {
        if (error.response && error.response.status === 404) {
        console.log("404 error");
        }
        return Promise.reject(error);
    }
);
new Vue({
  render: (h) => h(App),
}).$mount("#app");
