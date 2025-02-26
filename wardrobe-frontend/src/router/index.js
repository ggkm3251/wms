
import { createRouter, createWebHistory } from 'vue-router';
import Login from '../views/Login.vue';
import Register from '../views/Register.vue';
import Dashboard from '../views/Dashboard.vue';
import AddItem from '../views/AddItem.vue';
import EditItem from '../views/EditItem.vue';

const routes = [
    { path: '/', component: Login },
    { path: '/register', component: Register },
    { path: '/dashboard', component: Dashboard },
    { path: '/add-item', component: AddItem },
    { path: '/edit-item/:id', component: EditItem },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;