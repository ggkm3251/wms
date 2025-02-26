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
import axios from 'axios';
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
                const response = await axios.post(`${import.meta.env.VITE_API_URL}/api/login`, {
                    email: this.email,
                    password: this.password,
                });
                localStorage.setItem('token', response.data.token);
                toast.success('Login successful!');
                this.$router.push('/dashboard');
            } catch {
                toast.error('Login failed. Please check your credentials.');
            }
        },
    },
};
</script>