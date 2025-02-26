<!-- src/components/Alert.vue -->
<template>
    <div v-if="message" :class="['alert', type]">
        {{ message }}
    </div>
</template>

<script>
export default {
    props: {
        message: String,
        type: {
            type: String,
            default: 'success', // Can be 'success', 'error', etc.
        },
    },
};
</script>

<style scoped>
.alert {
    padding: 10px;
    margin: 10px 0;
    border-radius: 4px;
}

.success {
    background-color: #d4edda;
    color: #155724;
}

.error {
    background-color: #f8d7da;
    color: #721c24;
}
</style>