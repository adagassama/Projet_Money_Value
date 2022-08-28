import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import Toaster from '@meforma/vue-toaster';

const app = createApp(App)

app.use(router)

app.use(Toaster, {timeout: 3000})

app.mount('#app')
