import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import apiClient from './api'; // Import the Axios instance

const app = createApp(App);

// Make the Axios instance available globally
app.config.globalProperties.$api = apiClient;

app.use(router).mount('#app');
