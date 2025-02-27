<template>
    <div>
        <h1>Register</h1>
        <form @submit.prevent="register">
            <input type="text" v-model="name" placeholder="Name" required />
            <input type="email" v-model="email" placeholder="Email" required />
            <input type="password" v-model="password" placeholder="Password" required />
            <input type="password" v-model="passwordConfirmation" placeholder="Confirm Password" required />
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <router-link to="/">Login</router-link></p>
    </div>
</template>

<script>
import apiClient, { fetchCsrfCookie } from '@/api';
import { useToast } from 'vue-toastification';

export default {
    data() {
        return {
            name: '',
            email: '',
            password: '',
            passwordConfirmation: '',
        };
    },
    methods: {
        async register() {
            const toast = useToast();
            try {
                // Fetch CSRF token before making the registration request
                await fetchCsrfCookie();

                // Make the registration request
                const response = await apiClient.post('/api/register', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.passwordConfirmation,
                });

                // Show success message and redirect
                toast.success('Registration successful!');
                this.$router.push('/');
            } catch (error) {
                // Handle errors
                if (error.response?.data?.errors) {
                    const errorMessages = Object.values(error.response.data.errors).flat().join('\n');
                    toast.error(`Registration failed:\n${errorMessages}`);
                } else {
                    toast.error('Registration failed. Please try again.');
                }
            }
        },
    },
};
</script>