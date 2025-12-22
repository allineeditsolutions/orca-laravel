<template>
    <div id="app">
        <RouterView />
        <Toast position="top-right" />
    </div>
</template>

<script setup>
import { RouterView } from 'vue-router';
import Toast from 'primevue/toast';
</script>

