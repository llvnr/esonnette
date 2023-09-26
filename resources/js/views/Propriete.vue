<template>

    <div v-if="!loadData" class="ShellLoader">
        <Loader />
    </div>
    <div v-else class="ShellDashboard">

        <Sidebar :isLogging="true" />

        <div class="ShellDashboard__content">

            <div class="ShellDashboard__content-header">

                <Header title="Mes propriétés" />

            </div>
            <div class="ShellDashboard__content-body">

                <Message :visibility="isVisibilityMessageOne" :type="isTypeMessageOne" :message="isMessageOne" />

                <div class="ContentBodyPropriete">

                    <div class="ContentBodyPropriete__colonneUn">
                        <router-link to="/addpropriete" class="noDecor"><button class="ContentBodyPropriete__colonneUn-btnPropriete">Nouveau</button></router-link>
                    </div>
                    <div class="ContentBodyPropriete__colonneDeux">
                        
                        <Message v-if="!dataIsOkay" :visibility="isVisibilityMessageTwo" :type="isTypeMessageTwo" :message="isMessageTwo" />

                        <router-link :to="'/voir-propriete/' + item.id" v-for="(item, index) in proprietes" v-else class="cardPropriete noDecor">

                            <div class="cardPropriete__label-id">{{ item.id }}</div>
                            <div class="cardPropriete__label-image"><img :src="item.qrcode" width="50" /></div>
                            <div class="cardPropriete__label-name">{{ item.nom }}</div>
                            <div class="cardPropriete__label-surname">{{ item.prenom }}</div>
                            <div class="cardPropriete__label-adresse">{{ item.adresse }}</div>
                            <div class="cardPropriete__label-codepostal">{{ item.codepostal }}</div>
                            <div class="cardPropriete__label-ville">{{ item.ville }}</div>
                            <div class="cardPropriete__label-visite">0 Visite(s)</div>

                        </router-link>
                        
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
            proprietes: null,
            isVisibilityMessageOne: false,
            isTypeMessageOne: 'danger',
            isMessageOne: "",
            isVisibilityMessageTwo: true,
            isTypeMessageTwo: 'danger',
            isMessageTwo: "Aucune propriété disponible."
        }
    },
    mounted() {
        this.getPropriete()
    },
    methods: {
        getPropriete() {
            
            const authStore = useAuthStore();
            const token = authStore.token;

            fetch('/api/auth/allPropriete', {
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
                if(data !== undefined){
                    if(data.status){
                        // console.log(data)
                        if(data.result.length != 0){
                            this.dataIsOkay = true
                            this.proprietes = data.result
                            this.loadData = true
                        } else {
                            this.loadData = true
                            this.isVisibilityMessageTwo = true 
                            this.isTypeMessageTwo = "danger"
                            this.isMessageTwo = "Vous n'avez aucun propriété."

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