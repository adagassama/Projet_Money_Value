import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import Toaster from '@meforma/vue-toaster';
import axios from 'axios'

axios.defaults.baseURL = 'http://127.0.0.1:8000/api/';

function loggedIn(){
    return localStorage.getItem('token')
}

const app = createApp(App)

app.use(router)

app.use(Toaster, {timeout: 3000})

app.mount('#app')
