<template>

    <div class="ShellDashboard__sidebar">

        <div class="ShellDashboard__sidebar-header">
            <img src="/assets/images/logo.png" width="150" class="ShellDashboard__sidebar-header-title" />
        </div>
        <div class="ShellDashboard__sidebar-content">
            <ul v-if="isLogging" class="SidebarContent__navigation">
                <router-link to="/"  class="noDecor"><li class="SidebarContent__navigation-element">Dashboard</li></router-link>
                <router-link to="/propriete" class="noDecor"><li class="SidebarContent__navigation-element">Mes propriétés</li></router-link>
                <router-link to="/editeur" class="noDecor"><li class="SidebarContent__navigation-element">Editeur de sticker</li></router-link>
                <li class="SidebarContent__navigation-element noDecor" @click="Logout">Déconnexion</li>
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
        Logout() {

            let token = localStorage.getItem("token");

            fetch('/api/auth/logout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                }
            })
            .then(response => {
                // Gérer la réponse ici, si nécessaire
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Erreur de réponse du serveur');
                }
            })
            .then(data => {
                
                localStorage.removeItem("token")
                localStorage.removeItem("email")

                // this.$router.push('/connexion')
                window.location.assign('/connexion');
                
            })
            .catch(error => console.log(error));

        }
    }
};

</script>