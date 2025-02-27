import axios from 'axios';

// Create an Axios instance
const apiClient = axios.create({
    baseURL: import.meta.env.VITE_API_URL,
    withCredentials: true, // Required for cookies
});

// Enable automatic CSRF token handling
axios.defaults.withXSRFToken = true;

// Function to fetch CSRF cookie for Laravel Sanctum
export const fetchCsrfCookie = async () => {
    return apiClient.get('/sanctum/csrf-cookie');
};

// Add an interceptor to include the CSRF token in every request
apiClient.interceptors.request.use((config) => {
    // Get the CSRF token from the cookie
    const token = document.cookie
        .split('; ')
        .find(row => row.startsWith('XSRF-TOKEN='))
        ?.split('=')[1];

    // Add the CSRF token to the headers
    if (token) {
        config.headers['X-XSRF-TOKEN'] = token;
    }

    return config;
});

export default apiClient;