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
import axios from 'axios';

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
            try {
                const response = await axios.post('http://localhost:8000/api/register', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.passwordConfirmation,
                });

                // Log the successful response
                console.log('Registration successful:', response.data);

                // Redirect to the login page after successful registration
                this.$router.push('/');
            } catch (error) {
                // Log the full error response
                console.error('Registration failed:', error.response?.data || error.message);

                // Display a user-friendly error message
                if (error.response?.data?.errors) {
                    // Handle validation errors
                    const errorMessages = Object.values(error.response.data.errors).flat().join('\n');
                    alert(`Registration failed:\n${errorMessages}`);
                } else {
                    // Handle other errors (e.g., server errors)
                    alert('Registration failed. Please try again.');
                }
            }
        },
    },
};
</script>