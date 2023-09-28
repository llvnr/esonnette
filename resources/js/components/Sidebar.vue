<template>

    <div class="ShellDashboard__sidebar" id="ShellDashboard__sidebar">

        <div class="ShellDashboard__sidebar-header">
            <img :src="logo" width="150" class="ShellDashboard__sidebar-header-title" />
        </div>
        <div class="ShellDashboard__sidebar-content">
            <ul v-if="isLogging" class="SidebarContent__navigation">
                <router-link to="/"  class="noDecor"><li class="SidebarContent__navigation-element">Dashboard</li></router-link>
                <router-link to="/propriete" class="noDecor"><li class="SidebarContent__navigation-element">Mes propriétés</li></router-link>
                <router-link to="/editeur" class="noDecor"><li class="SidebarContent__navigation-element">Editeur de sticker</li></router-link>
                <li class="SidebarContent__navigation-element noDecor" @click="handleLogout">Déconnexion</li>
            </ul>
            <ul v-else class="SidebarContent__navigation">
                <router-link to="/connexion"  class="noDecor"><li class="SidebarContent__navigation-element">Connexion</li></router-link>
                <router-link to="/inscription" class="noDecor"><li class="SidebarContent__navigation-element">Inscription</li></router-link>
            </ul>

        </div>

    </div>

</template>

<script>

import { useAuthStore } from '../stores/auth.js';

export default {
    data() {
        return {
            logo: '/assets/images/logo.png',
            isLogging: false
        }
    },
    mounted() {
        this.checkIsLogging()
    },
    methods: {
        checkIsLogging() {
            const authStore = useAuthStore();

            this.isLogging = authStore.isAuthenticated

        },
        async handleLogout() {

            // Obtenez une référence au store d'authentification
            const authStore = useAuthStore();

            const logoutSuccessful = await authStore.logout();

            if(logoutSuccessful){
                this.$router.push('/connexion')
            } else {
                alert('Déconnexion impossible.')
            }

        }
    }
};

</script>