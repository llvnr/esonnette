<template>

    <div class="ShellDashboard">

        <Sidebar />

        <div class="ShellDashboard__content">

            <div class="ShellDashboard__content-header">

                <Header title="Modifier une alerte" />

            </div>
            <div class="ShellDashboard__content-body">

                <Message :visibility="isVisibilityMessage" :type="isTypeMessage" :message="isMessage" />

                <div v-if="typeAlert === 'email'">
                    
                    <div class="ContentBodyADDAlertEmail">

                        <div class="ContentBodyADDAlertEmail__label-email">Adresse email</div>
                        <input type="email" class="ContentBodyADDAlertEmail__input-email" v-model="email" placeholder="Adresse email de destination">

                        <div class="ContentBodyADDAlertEmail__label-etat">Etat</div>
                        <select v-model="etat" class="ContentBodyADDAlertEmail__select-etat">
                            <option :value="2">Default</option>
                            <option :value="1">Activé</option>
                            <option :value="0">Désactivé</option>
                        </select>

                        <button class="ContentBodyADDAlertEmail__btnAddEmail" @click="this.updateAlert">Modifier</button>
                        <button class="ContentBodyADDAlertEmail__btnGoBack" @click="this.goBack">Retour</button>

                    </div>

                </div>
                <div v-else-if="typeAlert === 'discord'">

                    <div class="ContentBodyADDAlertDiscord">

                        <div class="ContentBodyADDAlertDiscord__label-discord">Webhook discord</div>
                        <input type="text" class="ContentBodyADDAlertDiscord__input-discord" v-model="discord" placeholder="Webhook discord">

                        <div class="ContentBodyADDAlertDiscord__label-etat">Etat</div>
                        <select v-model="etat" class="ContentBodyADDAlertDiscord__select-etat">
                            <option :value="2">Default</option>
                            <option :value="1">Activé</option>
                            <option :value="0">Désactivé</option>
                        </select>

                        <button class="ContentBodyADDAlertDiscord__btnAddDiscord" @click="this.updateAlert">Modifier</button>
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

    </div>

</template>

<script>

import { useAuthStore } from '../stores/auth.js';

import Message from '../components/Message.vue';
import Sidebar from '../components/Sidebar.vue';
import Header from '../components/Header.vue';

export default {
    data() {
        return {
            getID: null,
            typeAlert: null,
            email: '',
            discord: '',
            etat: null,
            alert: {},
            isVisibilityMessage: false,
            isTypeMessage: 'success',
            isMessage: ''
        }
    },
    mounted() {
        this.getID = this.$route.params.id
        this.typeAlert = this.$route.params.type
        this.getAlerte()
    },
    methods: {
        goBack() {
            this.$router.go(-1)
        },
        getAlerte(){

            const authStore = useAuthStore();
            const token = authStore.token;
            
            fetch('/api/auth/getOneAlerte', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
                body: JSON.stringify({
                    id: this.getID
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
                        if(data.result.length != 0){
                            if(this.typeAlert === 'email'){
                                this.email = data.result.informations
                            } else if(this.typeAlert === 'discord') {
                                this.discord = data.result.informations
                            }
                            this.dataIsOkay = true
                            this.etat = data.result.etat
                            this.alert = data.result
                            this.loadData = true
                        } else {
                            this.loadData = true
                            this.isVisibilityMessage = true 
                            this.isTypeMessage = "danger"
                            this.isMessage = data.message

                            setTimeout(() => {
                                this.isVisibilityMessage = false;
                            }, 3000);
                        }
                    } else {
                        this.isVisibilityMessage = true 
                        this.isTypeMessage = "danger"
                        this.isMessage = data.message

                        setTimeout(() => {
                            this.isVisibilityMessage = false;
                        }, 3000);
                    }
                }
            })
            .catch(error => console.log(error));


        },
        updateAlert(){

            let id = this.alert.id 
            let type = this.typeAlert
            let informations
            if(type === "email"){
                informations = this.email
            } else if(type === "discord"){
                informations = this.discord
            }
            let etat = this.etat

            const authStore = useAuthStore();
            const token = authStore.token;
            
            fetch('/api/auth/updateAlerte', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
                body: JSON.stringify({
                    id: id,
                    type: type,
                    informations: informations,
                    etat: etat
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
                        this.isVisibilityMessage = true 
                        this.isTypeMessage = "success"
                        this.isMessage = "L'alerte a bien été mis à jour."

                        setTimeout(() => {
                            this.isVisibilityMessage = false;
                        }, 3000);
                    } else {
                        this.isVisibilityMessage = true 
                        this.isTypeMessage = "danger"
                        this.isMessage = data.message

                        setTimeout(() => {
                            this.isVisibilityMessage = false;
                        }, 3000);
                    }
                }
            })
            .catch(error => console.log(error));

        },
        checkRequiredField(fieldName, fieldValue) {
            if (fieldValue.length === 0) {
                this.isVisibilityMessage = true 
                this.isTypeMessage = "danger"
                this.isMessage = `Le champ [${fieldName}] est obligatoire.`

                setTimeout(() => {
                    this.isVisibilityMessage = false;
                }, 3000);
                return false; // Indique que la validation a échoué
            }
            return true; // Indique que la validation a réussi
        }
    },
    components: { Sidebar, Header, Message  }
}

</script>