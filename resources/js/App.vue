<template>
    HELLO !
    <TestComponent />
</template>

<script setup>
import TestComponent from "./components/TestComponent.vue"
import { onMounted } from 'vue';

onMounted(() => console.log('Hello world !')) 

</script>