<template>

    <div class="ShellDashboard__content">

        <div class="ShellDashboard__content-header">

            <Header title="Fiche d'informations" />

        </div>
        <div class="ShellDashboard__content-body">

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
                                <img :src="infoPropriete.qrcode" width="100" alt="">
                            </div>
                            <div class="ContentColonneDeux__label-content">
                                <div class="ContentColonneDeux__label-visite-total"><b>0</b> Visite(s) totale(s)</div>
                                <div class="ContentColonneDeux__label-visite-manquer"><b>0</b> Visite(s) manqué</div>
                                <div class="ContentColonneDeux__label-qrcode">Etat du QRCODE : 
                                    <span v-if="infoPropriete.status" class="ContentColonneDeux__label-etat-qrcode state-activate">Activé</span>
                                    <span v-else class="ContentColonneDeux__label-etat-qrcode state-desactivate">Désactivé</span>
                                </div> 
                                
                            </div>

                        </div>

                        <button class="ContentColonneDeux__btn-alerte">Gérer les alertes</button>


                    </div>
                </div>

                <div class="ContentBodyDataVisite">
                    
                    <div v-for="n in 10" class="cardVisite">

                        <div class="cardVisite__label-id">1</div>
                        <div class="cardVisite__label-image"><img src="https://img.icons8.com/?size=40&id=Hjmjz1QamXpz&format=png" alt=""></div>
                        <div class="cardVisite__label-date">29/08/2023</div>
                        <div class="cardVisite__label-heure">11:37</div>
                        <div class="cardVisite__label-name">Nom ou nom d'entreprise</div>
                        <div class="cardVisite__label-type">Type : Email / Discord / Sms</div>
                        <div class="cardVisite__label-status">Statut</div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</template>

<script>

import Header from '../components/Header.vue';

export default {
    data() {
        return {
            infoPropriete: {}
        }
    },
    mounted() {
        this.getOnePropriete()
    },
    methods: {
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
                        alert(data.message)
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
                        alert(data.message)
                    }
                }
            })
            .catch(error => console.log(error));

        }
    },
    components: { Header }

}

</script>