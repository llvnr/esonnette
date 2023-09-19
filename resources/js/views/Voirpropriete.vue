<template>

    <div class="ShellDashboard">

        <Sidebar :isLogging="true" />

        <div class="ShellDashboard__content">

            <div class="ShellDashboard__content-header">

                <Header title="Fiche d'informations" />

            </div>
            <div class="ShellDashboard__content-body">

                <Message :visibility="isVisibilityMessageOne" :type="isTypeMessageOne" :message="isMessageOne" />

                <div class="ContentBodyVoirPropriete">

                    <div class="ContentBodyVoirPropriete__content">
                        <div class="ContentBodyVoirPropriete__content-colonneUn">

                            <div class="ContentColonneUn__Card">
                                <div class="ContentColonneUn__label-image">
                                    <img v-if="infoPropriete.typepropriete === 'Maison'" src="https://img.icons8.com/?size=100&id=np6r5nc6uNNj&format=png" alt="">
                                    <img v-else-if="infoPropriete.typepropriete === 'Appartement'" src="https://img.icons8.com/?size=100&id=FrBSkVzw5GE_&format=png" />
                                </div>
                                <div class="ContentColonneUn__label-content">
                                    <div class="ContentColonneUn__label-fullname">{{ infoPropriete.prenom + ' ' + infoPropriete.nom }}</div>
                                    <div class="ContentColonneUn__label-adresse">{{ infoPropriete.adresse }}</div>
                                    <div class="ContentColonneUn__label-codepostal">{{ infoPropriete.codepostal  }}</div>
                                    <div class="ContentColonneUn__label-ville">{{ infoPropriete.ville }}</div>
                                </div>
                            </div>

                            <button v-if="infoPropriete.status" class="ContentColonneUn__btn-disableqr" @click="changeStateQrcode(0)">Désactiver le QrCode</button>
                            <button v-else class="ContentColonneUn__btn-enableqr" @click="changeStateQrcode(1)">Activer le QrCode</button>

                        </div>
                        <div class="ContentBodyVoirPropriete__content-colonneDeux">

                            <div class="ContentColonneDeux__Card">

                                <div class="ContentColonneDeux__label-image">
                                    <router-link :to="'/propriete/qrcode/' + getID">
                                        <img :src="infoPropriete.qrcode" width="100" alt="">
                                    </router-link>
                                </div>
                                <div class="ContentColonneDeux__label-content">
                                    <div class="ContentColonneDeux__label-visite-total"><b>{{ allVisite.length }}</b> Visite(s) reçu totale(s)</div>
                                    <div class="ContentColonneDeux__label-qrcode">Etat du QRCODE : 
                                        <span v-if="infoPropriete.status" class="ContentColonneDeux__label-etat-qrcode state-activate">Activé</span>
                                        <span v-else class="ContentColonneDeux__label-etat-qrcode state-desactivate">Désactivé</span>
                                    </div> 
                                    
                                </div>

                            </div>

                            <router-link :to="'/alerte/show/one/' + getID">
                                <button class="ContentColonneDeux__btn-alerte">Gérer les alertes</button>
                            </router-link>

                        </div>
                    </div>

                    <Message v-if="!dataIsOkay" :visibility="isVisibilityMessageTwo" :type="isTypeMessageTwo" :message="isMessageTwo" />

                    <div v-else class="ContentBodyDataVisite">
                        
                        <div v-for="(item, index) in allVisite" class="cardVisite">

                            <div class="cardVisite__label-id">{{ item.id }}</div>
                            <div class="cardVisite__label-image"><img src="https://img.icons8.com/?size=40&id=Hjmjz1QamXpz&format=png" alt=""></div>
                            <div class="cardVisite__label-date">{{ formatDate(item.created_at) }}</div>
                            <div class="cardVisite__label-name">{{ item.denomination }}</div>
                            <div class="cardVisite__label-contact">{{ item.telephone }}</div>
                            <div v-if="item.alerte.type === 'email'" class="cardVisite__label-type">
                                <img src="https://img.icons8.com/?size=25&id=D9x0PpvvT1AL&format=png" />
                            </div>
                            <div v-else-if="item.alerte.type === 'discord'" class="cardVisite__label-type">
                                <img src="https://img.icons8.com/?size=25&id=30998&format=png" />
                            </div>
                            <div class="cardVisite__label-status" :class="item.etat ? 'state-activate-write' : 'state-desactivate-write'">
                                {{ item.etat ? 'Vu' : 'Manqué' }}
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</template>

<script>

import Message from '../components/Message.vue';
import Sidebar from '../components/Sidebar.vue';
import Header from '../components/Header.vue';

export default {
    data() {
        return {
            dataIsOkay: false,
            infoPropriete: {},
            allVisite: {},
            getID: null,
            isVisibilityMessageOne: false,
            isTypeMessageOne: 'danger',
            isMessageOne: "",
            isVisibilityMessageTwo: true,
            isTypeMessageTwo: 'danger',
            isMessageTwo: "Vous n'avez reçu aucune visite."
        }
    },
    mounted() {
        this.getID = this.$route.params.id
        this.getOnePropriete()
        this.getVisite()
    },
    methods: {
        formatDate(dateString) {
            const options = { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit' };
            return new Date(dateString).toLocaleDateString(undefined, options);
        },
        changeStateQrcode(state) {
 
            let etat = state
            let idPropriete = this.$route.params.id

            const token = localStorage.getItem('token');

            fetch('/api/auth/updatePropriete', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
                body: JSON.stringify({
                    id: idPropriete,
                    status: etat
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
                        this.infoPropriete = data.result
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

        },
        getOnePropriete() {

            let idPropriete = this.$route.params.id

            const token = localStorage.getItem('token');

            fetch('/api/auth/showPropriete', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
                body: JSON.stringify({
                    id: idPropriete
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
                        this.infoPropriete = data.result
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

        },
        getVisite() {

            const token = localStorage.getItem('token');

            fetch('/api/auth/getVisite', {
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
                            this.allVisite = data.result
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
    components: { Sidebar, Header, Message }

}

</script>