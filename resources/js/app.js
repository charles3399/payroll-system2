require('./bootstrap');

import { createApp } from "vue"
import Main from './Main.vue'
import router from './router'

createApp({
    components: {
        Main
    }
}).use(router).mount('#app')