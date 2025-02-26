import axios from 'axios';

const apiClient = axios.create({
    baseURL: import.meta.env.VITE_API_URL, // Ensure this points to your backend URL
    withCredentials: true, // Required for cookies
});

// Add a request interceptor to log headers
apiClient.interceptors.request.use((config) => {
    console.log('Request Headers:', config.headers);
    return config;
});

export const fetchCsrfCookie = async () => {
    await apiClient.get('/sanctum/csrf-cookie');
};

export default apiClient;