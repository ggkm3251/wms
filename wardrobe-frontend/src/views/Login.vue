<template>
    <div>
        <h1>Login</h1>
        <form @submit.prevent="login">
            <input type="email" v-model="email" placeholder="Email" required />
            <input type="password" v-model="password" placeholder="Password" required />
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <router-link to="/register">Register</router-link></p>
    </div>
</template>

<script>
import apiClient, { fetchCsrfCookie } from '@/api';
import { useToast } from 'vue-toastification';

export default {
    data() {
        return {
            email: '',
            password: '',
        };
    },
    methods: {
        async login() {
            const toast = useToast();
            try {
                // Fetch CSRF token before making the login request
                await fetchCsrfCookie();

                // Make the login request
                const response = await apiClient.post('/api/login', {
                    email: this.email,
                    password: this.password,
                });

                // Store the token in localStorage
                localStorage.setItem('token', response.data.token);

                // Show success message and redirect
                toast.success('Login successful!');
                this.$router.push('/dashboard');
            } catch (error) {
                // Handle errors
                if (error.response?.data?.errors) {
                    const errorMessages = Object.values(error.response.data.errors).flat().join('\n');
                    toast.error(`Login failed:\n${errorMessages}`);
                } else {
                    toast.error('Login failed. Please check your credentials.');
                }
            }
        },
    },
};
</script>