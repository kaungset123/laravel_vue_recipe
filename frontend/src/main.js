import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import './index.css'
import axios from 'axios'
import router from './router'
import store from './store'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faWarning } from '@fortawesome/free-solid-svg-icons'

library.add(faWarning)
axios.defaults.baseURL = "http://localhost:8000"

const app = createApp(App);
app.config.globalProperties.$axios = axios; // globaling the axios to be use the url without http://localhost:8000 and without importing axios everywhere
app.use(router)
app.use(store)
app.component('font-awesome-icon', FontAwesomeIcon)
app.mount('#app')
