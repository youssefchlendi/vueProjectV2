import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'jquery/src/jquery.js'
import 'bootstrap/dist/js/bootstrap.min.js'
import 'material-icons/iconfont/material-icons.css';

createApp(App).use(router).mount("#app");
