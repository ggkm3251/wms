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
import axios from 'axios';

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
            const response = await axios.get(`${import.meta.env.VITE_API_URL}/api/categories`, {
                headers: { Authorization: `Bearer ${token}` },
            });
            this.categories = response.data;
        },
        async addItem() {
            const token = localStorage.getItem('token');
            await axios.post(
                `${import.meta.env.VITE_API_URL}/api/clothing-items`,
                {
                    name: this.name,
                    description: this.description,
                    category: this.category,
                    image_url: this.imageUrl,
                },
                { headers: { Authorization: `Bearer ${token}` } }
            );
            this.$router.push('/dashboard');
        },
    },
};
</script>