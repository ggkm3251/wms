<template>
    <div>
        <h1>My Wardrobe</h1>
        <input type="text" v-model="search" placeholder="Search items..." />
        <select v-model="categoryFilter">
            <option value="">All Categories</option>
            <option v-for="category in categories" :key="category.id" :value="category.name">
                {{ category.name }}
            </option>
        </select>
        <button @click="fetchClothingItems">Apply Filters</button>

        <ul>
            <li v-for="item in clothingItems" :key="item.id">
                {{ item.name }} - {{ item.category }}
                <button @click="editItem(item.id)">Edit</button>
                <button @click="deleteItem(item.id)">Delete</button>
            </li>
        </ul>

        <router-link to="/add-item">Add New Item</router-link>
    </div>
</template>

<script>
import apiClient, { fetchCsrfCookie } from '@/api';
import { useToast } from 'vue-toastification';

export default {
    data() {
        return {
            clothingItems: [],
            categories: [],
            search: '',
            categoryFilter: '',
        };
    },
    async created() {
        await this.fetchClothingItems();
        await this.fetchCategories();
    },
    methods: {
        async fetchClothingItems() {
            const token = localStorage.getItem('token');
            try {
                await fetchCsrfCookie(); // Fetch CSRF token
                const response = await apiClient.get('/api/clothing-items', {
                    headers: { Authorization: `Bearer ${token}` },
                    params: { search: this.search, category: this.categoryFilter },
                });
                this.clothingItems = response.data;
            } catch (error) {
                console.error('Failed to fetch clothing items:', error);
            }
        },
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
        editItem(id) {
            this.$router.push(`/edit-item/${id}`);
        },
        async deleteItem(id) {
            const token = localStorage.getItem('token');
            const toast = useToast();
            try {
                await fetchCsrfCookie(); // Fetch CSRF token
                await apiClient.delete(`/api/clothing-items/${id}`, {
                    headers: { Authorization: `Bearer ${token}` },
                });
                toast.success('Item deleted successfully!');
                this.fetchClothingItems();
            } catch (error) {
                toast.error('Failed to delete item. Please try again.');
            }
        },
    },
};
</script>