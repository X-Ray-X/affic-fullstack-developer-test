require('./bootstrap');

import "bootstrap/dist/css/bootstrap.min.css"

import { createApp} from 'vue';
import FrontPage from './components/Home.vue'

const app = createApp();
app.component("front-page", FrontPage);
app.mount("#app");

import "bootstrap/dist/js/bootstrap.js"
