import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import './index.css'
import axios from 'axios'

axios.defaults.baseURL = "http://localhost:8000"

const app = createApp(App)

app.config.globalProperties.$axios = axios; // globaling the axios to be use the url without http://localhost:8000 and without importing axios everywhere
app.mount('#app')
