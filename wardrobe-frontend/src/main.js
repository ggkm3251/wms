import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import apiClient from './api'; // Import the Axios instance
import Toast from 'vue-toastification';
import 'vue-toastification/dist/index.css'; // Import the CSS

const app = createApp(App);

// Configure Vue Toastification
const toastOptions = {
    timeout: 3000, // Duration of the toast (in milliseconds)
    position: 'top-right', // Position of the toast
    closeOnClick: true, // Close toast on click
    pauseOnFocusLoss: true, // Pause toast when the window loses focus
    pauseOnHover: true, // Pause toast on hover
    draggable: true, // Allow dragging the toast
    draggablePercent: 0.6, // How much of the toast must be dragged to close it
    showCloseButtonOnHover: true, // Show close button on hover
    hideProgressBar: false, // Show progress bar
    closeButton: 'button', // Use a button for closing the toast
    icon: true, // Show an icon based on the toast type
};


// Make the Axios instance available globally
app.config.globalProperties.$api = apiClient;

app.use(Toast, toastOptions); // Use Vue Toastification
app.use(router).mount('#app');
