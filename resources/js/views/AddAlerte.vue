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

                    <button class="ContentBodyADDAlertEmail__btnAddEmail" @click="this.createAlertEmail">Créer</button>
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
            getID: null,
            typeAlert: null,
            email: ''
        }
    },
    mounted() {
        this.getID = this.$route.params.id
        this.typeAlert = this.$route.params.type
    },
    methods: {
        goBack() {
            this.$router.go(-1)
        },
        createAlertEmail() {

            let id = this.getID
            let email = this.email
            let type = this.typeAlert

            if(email.length == 0) return alert('Le champ [EMAIL] est obligatoire.')

            const token = localStorage.getItem('token');

            fetch('/api/auth/createAlerte', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
                body: JSON.stringify({
                    id: id,
                    type: type,
                    data: email
                })
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
                if(data !== undefined){
                    if(data.status){
                        alert("L'alerte email a bien été créer.")
                        this.$router.go(-1)
                    } else {
                        alert(data.message)
                    }
                }
            })
            .catch(error => console.log(error));

        }
    },
    components: { Header  }
}

</script>