<template>
    <div class="ShellDashboard">

        <div class="ShellDashboard__sidebar">

            <div class="ShellDashboard__sidebar-header">
                <img src="assets/images/logo.png" width="150" class="ShellDashboard__sidebar-header-title" />
            </div>
            <div class="ShellDashboard__sidebar-content">
                
                <ul class="SidebarContent__navigation">
                    <a href="/" class="noDecor"><li class="SidebarContent__navigation-element">Dashboard</li></a>
                    <a href="/propriete" class="noDecor"><li class="SidebarContent__navigation-element">Mes propriétés</li></a>
                    <a href="/parametres" class="noDecor"><li class="SidebarContent__navigation-element">Paramètres</li></a>
                    <a href="/" class="noDecor"><li class="SidebarContent__navigation-element">Déconnexion</li></a>
                </ul>

            </div>

        </div>

        <Dashboard />

    </div>

</template>

<script setup>
import Dashboard from "./views/Dashboard.vue";
import { onMounted } from 'vue';

onMounted(() => console.log('Hello world !')) 

</script>