<template>

    <div v-if="!loadData" class="ShellLoader">
        <Loader />
    </div>
    <div v-else class="ShellDashboard">

        <Sidebar />

        <div class="ShellDashboard__content">

            <div class="ShellDashboard__content-header">

                <Header title="Dashboard" />

            </div>
            <div class="ShellDashboard__content-body">

                <div class="ContentBody__row">

                    <Card title="Content de vous revoir !" description="Ici vous pouvez voir toutes les données importantes en un seul endroit !"></Card>
                    <Card :counter="utilisateur" title="Utilisateur(s)" description="Comptabilise le nombre d'utilisateurs qui sont dans cette instance."></Card>
                    <Card :counter="role" title="Rôle(s)" description="Comptabilise le nombre de rôle qui sont dans cette instance."></Card>
                    <Card :counter="propriete" title="Propriétés" description="Comptabilise le nombre de propriétés associé à cette instance."></Card>
                    <Card :counter="notification" title="Alerte(s) totale(s)" description="Comptabilise le nombre d'alerte reçu sur l'ensemble des propriétés."></Card>
                    <Card :counter="notificationEmail" title="Alerte(s) email(s)" description="Comptabilise le nombre d'alertes par email envoyées sur l'ensemble des propriétés."></Card>
                    <Card :counter="notificationDiscord" title="Alerte(s) discord" description="Comptabilise le nombre d'alertes discord envoyés sur l'ensemble des propriétés."></Card>
                    <Card :counter="notificationSMS" title="Alerte(s) SMS" description="Comptabilise le nombre d'alertes SMS envoyés sur l'ensemble des propriétés."></Card>
                    <Card :counter="notificationSlack" title="Alerte(s) Slack" description="Comptabilise le nombre d'alertes Slack envoyés sur l'ensemble des propriétés."></Card>

                </div>

            </div>

        </div>

    </div>

</template>

<script>

import { useAuthStore } from "../stores/auth.js";

import Loader from '../components/Loader.vue';
import Card from '../components/Card.vue';
import Sidebar from "../components/Sidebar.vue";
import Header from "../components/Header.vue";

export default {
    data(){
        return {
            loadData: false,
            utilisateur: null,
            role: null,
            propriete: null,
            notification: null,
            notificationEmail: null,
            notificationDiscord: null,
            notificationSMS: null,
            notificationSlack: null
        }
    },
    mounted() {
        this.initDashboard()
    },
    methods: {
        initDashboard() {
            const authStore = useAuthStore();
            const token = authStore.token;

            fetch('/api/auth/getDashboard', {
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
                console.log(data)
                if(data !== undefined){
                    if(data.status){
                        this.utilisateur = data.data.utilisateur
                        this.role = data.data.role
                        this.propriete = data.data.propriete
                        this.notification = data.data.notification
                        this.notificationEmail = data.data.notification_email
                        this.notificationDiscord = data.data.notification_discord
                        this.notificationSMS = data.data.notification_sms
                        this.notificationSlack = data.data.notification_slack
                        this.loadData = true
                    } else {
                        alert(data.message)
                    }
                }
            })
            .catch(error => console.log(error));
        }
    },
    components: { Sidebar, Header, Card, Loader }
}

</script>