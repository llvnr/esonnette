<template>

    <div class="ShellDashboard">

        <Sidebar :isLogging="true" />

        <div class="ShellDashboard__content">

            <div class="ShellDashboard__content-header">

                <Header title="Création d'une propriété" />

            </div>
            <div class="ShellDashboard__content-body">

                <Message :visibility="isVisibilityMessage" :type="isTypeMessage" :message="isMessage" />

                <div class="ContentBodyADDPropriete">

                    <div class="ContentBodyADDPropriete__label-name">Nom du propriétaire</div>
                    <input type="text" class="ContentBodyADDPropriete__input-name" v-model="nom" placeholder="Nom du propriétaire">

                    <div class="ContentBodyADDPropriete__label-surname">Prénom du propriétaire</div>
                    <input type="text" class="ContentBodyADDPropriete__input-surname" v-model="prenom" placeholder="Prénom du propriétaire">

                    <div class="ContentBodyADDPropriete__label-type">Type de propriété</div>
                    <select class="ContentBodyADDPropriete__select-type" v-model="typepropriete">
                        <option value="Maison">Maison</option>
                        <option value="Appartement">Appartement</option>
                    </select>

                    <div class="ContentBodyADDPropriete__label-adresse">Adresse de la propriété</div>
                    <input type="text" class="ContentBodyADDPropriete__input-adresse" v-model="adresse" placeholder="Adresse de la propriété">

                    <div class="ContentBodyADDPropriete__label-codepostal">Code postal</div>
                    <input type="text" class="ContentBodyADDPropriete__input-codepostal" v-model="codepostal" placeholder="Code postal">

                    <div class="ContentBodyADDPropriete__label-ville">Ville</div>
                    <input type="text" class="ContentBodyADDPropriete__input-ville" v-model="ville" placeholder="Ville">

                    <div class="ContentBodyADDPropriete__label-alerte">Alerte par default</div>
                    <select v-model="typeAlert" class="ContentBodyADDPropriete__select-alert">
                        <option value="email">Email</option>
                        <option value="discord">Discord</option>
                    </select>

                    <div v-if="typeAlert === 'email'" class="ContentBodyADDProprieteAlertEmail">

                        <div class="ContentBodyADDProprieteAlertEmail__label-email">Adresse email</div>
                        <input type="email" class="ContentBodyADDProprieteAlertEmail__input-email" v-model="alertData" placeholder="Adresse email de destination">

                    </div>

                    <div v-else-if="typeAlert === 'discord'" class="ContentBodyADDProprieteAlertDiscord">

                        <div class="ContentBodyADDProprieteAlertDiscord__label-discord">Url Webhook</div>
                        <input type="text" class="ContentBodyADDProprieteAlertDiscord__input-discord" v-model="alertData" placeholder="Adresse email de destination">

                    </div>

                    <button class="ContentBodyADDPropriete__btnadd" @click="this.addPropriete">Créer</button>

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
            typeAlert: 'email',
            alertData: '',
            nom: '',
            prenom: '',
            typepropriete: 'Maison',
            adresse: '',
            codepostal: '',
            ville: '',
            isVisibilityMessage: false,
            isTypeMessage: 'success',
            isMessage: ''
        }
    },
    methods: {
        addPropriete() {

            let nom = this.nom 
            let prenom = this.prenom
            let typepropriete = this.typepropriete
            let adresse = this.adresse
            let codepostal = this.codepostal
            let ville = this.ville
            let typeAlert = this.typeAlert
            let alertData = this.alertData

            if (!this.checkRequiredField('NOM', nom)) return;
            if (!this.checkRequiredField('PRENOM', prenom)) return;
            if (!this.checkRequiredField('TYPE DE PROPRIETE', typepropriete)) return;
            if (!this.checkRequiredField('ADRESSE', adresse)) return;
            if (!this.checkRequiredField('CODE POSTAL', codepostal)) return;
            if (!this.checkRequiredField('VILLE', ville)) return;
            if (!this.checkRequiredField('EMAIL ou WEBHOOK', alertData)) return;

            const authStore = useAuthStore();
            const token = authStore.token;

            fetch('/api/auth/createPropriete', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
                body: JSON.stringify({
                    nom: nom,
                    prenom: prenom,
                    typepropriete: typepropriete,
                    adresse: adresse,
                    codepostal: codepostal,
                    ville: ville,
                    typeAlert: typeAlert,
                    alertData: alertData
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
                        console.log(data)

                        this.isVisibilityMessage = true 
                        this.isTypeMessage = "success"
                        this.isMessage = data.message

                        setTimeout(() => {
                            this.isVisibilityMessage = false;
                            this.$router.push('/propriete')
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
    components: { Sidebar, Header, Message }
}

</script>