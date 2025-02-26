<!-- src/App.vue -->
<template>
    <nav>
        <router-link to="/">Login</router-link> |
        <router-link to="/register">Register</router-link> |
        <router-link to="/dashboard">Dashboard</router-link>
    </nav>
    <router-view />
</template>

<style>
nav {
    padding: 1rem;
    background-color: #f0f0f0;
    text-align: center;
}
nav a {
    margin: 0 1rem;
    text-decoration: none;
    color: #333;
}
</style>