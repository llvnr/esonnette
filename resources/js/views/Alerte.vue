<template>

    <div v-if="!loadData" class="ShellLoader">
        <Loader />
    </div>
    <div v-else class="ShellDashboard">

        <Sidebar :isLogging="true" />

        <div class="ShellDashboard__content">

            <div class="ShellDashboard__content-header">

                <Header title="Gestion des alertes" />

            </div>
            <div class="ShellDashboard__content-body">

                <Message :visibility="isVisibilityMessageOne" :type="isTypeMessageOne" :message="isMessageOne" />

                <div class="ContentBodyAlerte">

                    <div class="ContentBodyAlerte__colonneUn">
                        <div class="ContentBodyAlerte__colonneUn-cUn">
                        <button @click="goBack" class="ContentBodyAlerte__colonneUn-btnBack">Retour</button>
                        </div>
                        <div class="ContentBodyAlerte__colonneUn-cDeux">
                            <select class="ContentBodyAlerte__select-type" v-model="typeAlerte">
                                <option value="email">Email</option>
                                <option value="discord">Discord</option>
                                <option value="sms">SMS (Indisponible)</option>
                                <option value="slack">Slack (Indisponible)</option>
                            </select>
                            <button class="ContentBodyAlerte__colonneUn-btn" @click="goAddAlert">Nouveau</button>
                        </div>
                    </div>
                    <div class="ContentBodyAlerte__colonneDeux">
                        
                        <Message v-if="!dataIsOkay" :visibility="isVisibilityMessageTwo" :type="isTypeMessageTwo" :message="isMessageTwo" />

                        <div v-for="(item, index) in allAlerte" v-else class="cardAlerte noDecor">

                            <div class="cardAlerte__label-id">{{ item.id }}</div>
                            <div v-if="item.type === 'email'" class="cardAlerte__label-logo"><img src="https://img.icons8.com/?size=25&id=D9x0PpvvT1AL&format=png" /></div>
                            <div v-else-if="item.type === 'discord'" class="cardAlerte__label-logo"><img src="https://img.icons8.com/?size=25&id=30998&format=png" /></div>
                            <div v-else-if="item.type === 'slack'" class="cardAlerte__label-logo">LOGO</div>
                            <div v-else-if="item.type === 'sms'" class="cardAlerte__label-logo">LOGO</div>
                            <div class="cardAlerte__label-type">{{ item.type }}</div>
                            <!-- <div class="cardAlerte__label-informations">{{ item.informations.substring(0, 21) }}</div> -->
                            <div v-if="item.etat == 2" class="cardAlerte__label-etat">Default</div>
                            <div v-else-if="item.etat == 1" class="cardAlerte__label-etat">Activé</div>
                            <div v-else-if="item.etat == 0" class="cardAlerte__label-etat">Désactivé</div>
                            <div class="cardAlerte__label-action">
                                <router-link :to="'/alerte/update/' + item.type + '/' + item.id"  class="noDecor">Modifier</router-link> - Delete
                            </div>

                        </div>
                        
                    </div>

                </div>

            </div>

        </div>

    </div>
 
</template>

<script>

import { useAuthStore } from '../stores/auth.js';

import Loader from '../components/Loader.vue';
import Message from '../components/Message.vue';
import Sidebar from '../components/Sidebar.vue';
import Header from '../components/Header.vue';

export default {
    data() {
        return {
            loadData: false,
            dataIsOkay: false,
            getID: null,
            typeAlerte: "email",
            allAlerte: {},
            isVisibilityMessageOne: false,
            isTypeMessageOne: 'danger',
            isMessageOne: "",
            isVisibilityMessageTwo: true,
            isTypeMessageTwo: 'danger',
            isMessageTwo: "Vous n'avez défini aucune alerte."
        }
    },
    mounted() {
        this.getID = this.$route.params.id
        this.getAlerte()
    },
    methods: {
        goBack() {
            this.$router.go(-1)
        },
        goAddAlert() {
            let typeAlert = this.typeAlerte
            if(typeAlert === "sms" || typeAlert === "slack"){
                alert('INDISPONIBLE POUR LE MOMENT.')
            } else {
                this.$router.push('/alerte/add/' + typeAlert + '/' + this.getID)
            }
        },
        getAlerte() {

            const authStore = useAuthStore();
            const token = authStore.token;
            
            fetch('/api/auth/getAlerte', {
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
                            this.dataIsOkay = true
                            this.allAlerte = data.result
                            this.loadData = true
                        } else {
                            this.loadData = true
                            this.isVisibilityMessageTwo = true 
                            this.isTypeMessageTwo = "danger"
                            this.isMessageTwo = "Aucune alerte définie."

                            setTimeout(() => {
                                this.isVisibilityMessageOne = false;
                            }, 3000);
                        }
                    } else {
                        this.isVisibilityMessageOne = true 
                        this.isTypeMessageOne = "danger"
                        this.isMessageOne = data.message

                        setTimeout(() => {
                            this.isVisibilityMessageOne = false;
                        }, 3000);
                    }
                }
            })
            .catch(error => console.log(error));

        }
    },
    components: { Sidebar, Header, Message, Loader }
}

</script>