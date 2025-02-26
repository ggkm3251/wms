import axios from 'axios';

const apiClient = axios.create({
    baseURL: import.meta.env.VITE_API_URL, // Ensure this points to your backend URL
    withCredentials: true, // Required for cookies
});

// Function to fetch CSRF cookie for Laravel Sanctum
export const fetchCsrfCookie = async () => {
    return apiClient.get('/sanctum/csrf-cookie');
};

export default apiClient;
