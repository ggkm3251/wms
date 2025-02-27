<template>
    <div>
        <h1>Edit Clothing Item</h1>
        <form @submit.prevent="updateItem">
            <input type="text" v-model="name" placeholder="Name" required />
            <textarea v-model="description" placeholder="Description"></textarea>
            <select v-model="category">
                <option v-for="category in categories" :key="category.id" :value="category.name">
                    {{ category.name }}
                </option>
            </select>
            <input type="text" v-model="imageUrl" placeholder="Image URL" />
            <button type="submit">Update Item</button>
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
        await this.fetchItem();
    },
    methods: {
        async fetchCategories() {
            const token = localStorage.getItem('token');
            const response = await apiClient.get('/api/categories', {
                headers: { Authorization: `Bearer ${token}` },
            });
            this.categories = response.data;
        },
        async fetchItem() {
            const token = localStorage.getItem('token');
            const response = await apiClient.get(
                `/api/clothing-items/${this.$route.params.id}`,
                { headers: { Authorization: `Bearer ${token}` } }
            );
            const item = response.data;
            this.name = item.name;
            this.description = item.description;
            this.category = item.category;
            this.imageUrl = item.image_url;
        },
        async updateItem() {
            const token = localStorage.getItem('token');
            const toast = useToast();
            try {
                // Fetch CSRF token before making the request
                await fetchCsrfCookie();

                // Make the request to update the clothing item
                const response = await apiClient.put(
                    `/api/clothing-items/${this.$route.params.id}`,
                    {
                        name: this.name,
                        description: this.description,
                        category: this.category,
                        image_url: this.imageUrl,
                    },
                    { headers: { Authorization: `Bearer ${token}` } }
                );

                // Show success message and redirect
                toast.success('Item updated successfully!');
                this.$router.push('/dashboard');
            } catch (error) {
                // Handle errors
                if (error.response?.data?.errors) {
                    const errorMessages = Object.values(error.response.data.errors).flat().join('\n');
                    toast.error(`Failed to update item:\n${errorMessages}`);
                } else {
                    toast.error('Failed to update item. Please try again.');
                }
            }
        },
    },
};
</script>