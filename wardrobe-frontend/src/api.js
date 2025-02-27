import axios from 'axios';

const apiClient = axios.create({
    baseURL: import.meta.env.VITE_API_URL,
    withCredentials: true, // Required for cookies
});

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

        console.log('CSRF Token from cookie:', token); // Debugging

    // Add the CSRF token to the headers
    if (token) {
        config.headers['X-XSRF-TOKEN'] = token;
    }

    console.log('Request headers:', config.headers); // Debugging

    return config;
});

export default apiClient;