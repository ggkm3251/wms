<template>
    <div>
        <h1>Add New Clothing Item</h1>
        <form @submit.prevent="addItem">
            <input type="text" v-model="name" placeholder="Name" required />
            <textarea v-model="description" placeholder="Description"></textarea>
            <select v-model="category">
                <option v-for="category in categories" :key="category.id" :value="category.name">
                    {{ category.name }}
                </option>
            </select>
            <input type="text" v-model="imageUrl" placeholder="Image URL" />
            <button type="submit">Add Item</button>
        </form>
        <router-link to="/dashboard">Back to Dashboard</router-link>
    </div>
</template>

<script>
import apiClient, { fetchCsrfCookie } from '@/api';
import { useToast } from 'vue-toastification';

export default {
    data() {
        return {
            name: '',
            description: '',
            category: '',
            imageUrl: '',
            categories: [],
        };
    },
    async created() {
        await this.fetchCategories();
    },
    methods: {
        async fetchCategories() {
            const token = localStorage.getItem('token');
            try {
                await fetchCsrfCookie(); // Fetch CSRF token
                const response = await apiClient.get('/api/categories', {
                    headers: { Authorization: `Bearer ${token}` },
                });
                this.categories = response.data; // Assign data to categories
                console.log('Categories:', this.categories); // Debugging
            } catch (error) {
                console.error('Failed to fetch categories:', error);
            }
        },
        async addItem() {
            const token = localStorage.getItem('token');
            const toast = useToast();
            try {
                await fetchCsrfCookie(); // Fetch CSRF token
                await apiClient.post(
                    '/api/clothing-items',
                    {
                        name: this.name,
                        description: this.description,
                        category: this.category,
                        image_url: this.imageUrl,
                    },
                    { headers: { Authorization: `Bearer ${token}` } }
                );
                toast.success('Item added successfully!');
                this.$router.push('/dashboard');
            } catch (error) {
                toast.error('Failed to add item. Please try again.');
            }
        },
    },
};
</script>