<template>

    <div class="ShellDashboard__content">

        <div class="ShellDashboard__content-header">

            <Header title="Ajouter une alerte" />

        </div>
        <div class="ShellDashboard__content-body">

            <div v-if="typeAlert === 'email'">
                
                <div class="ContentBodyADDAlertEmail">

                    <div class="ContentBodyADDAlertEmail__label-email">Adresse email</div>
                    <input type="email" class="ContentBodyADDAlertEmail__input-email" v-model="email" placeholder="Adresse email de destination">

                    <button class="ContentBodyADDAlertEmail__btnAddEmail">Créer</button>
                    <button class="ContentBodyADDAlertEmail__btnGoBack" @click="this.goBack">Retour</button>

                </div>

            </div>
            <div v-else-if="typeAlert === 'discord'">

                <div class="ContentBodyADDAlertDiscord">

                    <div class="ContentBodyADDAlertDiscord__label-discord">Webhook discord</div>
                    <input type="text" class="ContentBodyADDAlertDiscord__input-discord" v-model="discord" placeholder="Webhook discord">

                    <button class="ContentBodyADDAlertDiscord__btnAddDiscord">Créer</button>
                    <button class="ContentBodyADDAlertDiscord__btnGoBack" @click="this.goBack">Retour</button>

                </div>

            </div>
            <div v-else-if="typeAlert === 'sms'">
                SMS 
            </div>
            <div v-else-if="typeAlert === 'slack'">
                SLACK
            </div>

        </div>
    </div>

</template>

<script>

import Header from '../components/Header.vue';

export default {
    data() {
        return {
            typeAlert: null,
            email: ''
        }
    },
    methods: {
        goBack() {
            this.$router.go(-1)
        }
    },
    mounted() {
        this.typeAlert = this.$route.params.type
    },
    components: { Header  }
}

</script>