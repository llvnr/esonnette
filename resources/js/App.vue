<template>
    <div class="ShellDashboard">

        <Sidebar />

        <Dashboard />
        <!-- <Propriete /> -->
        <!-- <Profil /> -->
        <!-- <VoirPropriete /> -->
        <!-- <AddPropriete /> -->

    </div>

</template>

<script setup>
import Dashboard from "./views/Dashboard.vue";
import Propriete from "./views/Propriete.vue";
import Profil from "./views/Profil.vue";
import VoirPropriete from "./views/Voirpropriete.vue";
import AddPropriete from "./views/Addpropriete.vue";

import Sidebar from "./components/Sidebar.vue";

import { onMounted } from 'vue';

onMounted(() => console.log('Hello world !')) 

</script>