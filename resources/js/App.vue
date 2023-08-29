<template>
    <div class="ShellDashboard">

        <Sidebar :isLogging="true" />

        <router-view></router-view>

    </div>

</template>

<script setup>

import Sidebar from "./components/Sidebar.vue";

import { onMounted } from 'vue';

onMounted(() => console.log('Hello world !')) 

</script>