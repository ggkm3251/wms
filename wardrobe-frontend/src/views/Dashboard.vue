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
import axios from 'axios';

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
            const response = await axios.get(`${import.meta.env.VITE_API_URL}/api/clothing-items`, {
                headers: { Authorization: `Bearer ${token}` },
                params: { search: this.search, category: this.categoryFilter },
            });
            this.clothingItems = response.data;
        },
        async fetchCategories() {
            const token = localStorage.getItem('token');
            const response = await axios.get(`${import.meta.env.VITE_API_URL}/api/categories`, {
                headers: { Authorization: `Bearer ${token}` },
            });
            this.categories = response.data;
        },
        editItem(id) {
            this.$router.push(`/edit-item/${id}`);
        },
        async deleteItem(id) {
            const token = localStorage.getItem('token');
            await axios.delete(`${import.meta.env.VITE_API_URL}/api/clothing-items/${id}`, {
                headers: { Authorization: `Bearer ${token}` },
            });
            this.fetchClothingItems();
        },
    },
};
</script>