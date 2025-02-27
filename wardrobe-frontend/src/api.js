import axios from 'axios';

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

export default apiClient;