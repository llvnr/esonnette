<template>
    <div class="ShellScan">
        <div class="ShellScan__Header">
            <div class="ShellScan__Header-top">Bienvenue chez</div>
            <div class="ShellScan__Header-bottom">{{ getPropriete.prenom + ' ' + getPropriete.nom }}</div>
        </div>
        <div class="ShellScan__Body">
            <!-- <div class="ShellScan__Body-Title">{{ getPropriete.prenom + ' ' + getPropriete.nom }}</div> -->
            <Message :visibility="isVisibilityMessage" :type="isTypeMessage" :message="isMessage" />
            <div v-if="!checkChoice" class="ShellScan__Body-Content">
                <button v-if="statusQrcode" class="ShellScan__Body-Content-btn-sonner ShellBody__Body-Content-btn-sonner-disablebtn">Sonnette désactivé</button>
                <button v-else-if="!statusQrcode && etatQrcodeAnonymous && !etatDringDringAnonymous" class="ShellScan__Body-Content-btn-sonner ShellBody__Body-Content-btn-sonner-disablebtn">SONNER ({{ timerDringDring }}s)</button>
                <button v-else-if="!statusQrcode && etatQrcodeAnonymous && etatDringDringAnonymous" class="ShellScan__Body-Content-btn-sonner ShellBody__Body-Content-btn-sonner-enablebtn" @click="this.dringdring(true)">SONNER</button>
                <button class="ShellScan__Body-Content-btn-recontacter" @click="this.bascule(true)">ÊTRE RECONTACTER</button>
                <div class="ShellScan__Body-Content-infospub">
                    Besoin d'une sonnette comme ça chez vous ? <br> Rendez-vous sur 
                    <a href="https://esonnette.com" target="_blank">https://esonnette.com</a>
                </div>
            </div>
            <div v-else class="ShellScan__Body-Content">

                <div class="ShellScan__Body-Content-label">Qui êtes vous ?</div>
                <input type="text" class="ShellBody__Body-Content-input-name" v-model="denomination" placeholder="Votre nom ou entreprise" />
                <input type="text" class="ShellBody__Body-Content-input-telephone" v-model="telephone" placeholder="Votre numéro de téléphone" />
                <button v-if="statusQrcode" class="ShellScan__Body-Content-btn-sonner ShellBody__Body-Content-btn-sonner-disablebtn">Sonnette désactivé</button>
                <button v-else-if="!statusQrcode && etatQrcode && !etatDringDring" class="ShellBody__Body-Content-btn-sonner ShellBody__Body-Content-btn-sonner-disablebtn">Patientez...</button>
                <button v-else-if="!statusQrcode && etatQrcode && etatDringDring" class="ShellBody__Body-Content-btn-sonner ShellBody__Body-Content-btn-sonner-enablebtn" @click="this.dringdring(false)">Prevenir de votre passage</button>
                <button class="ShellBody__Body-Content-btn-back" @click="this.bascule(false)">Retour</button>
                <div class="ShellScan__Body-Content-infospub">
                    Besoin d'une sonnette comme ça chez vous ? <br> Rendez-vous sur 
                    <a href="https://esonnette.com" target="_blank">https://esonnette.com</a>
                </div>

            </div>
        </div>
    </div>
</template>

<script>

import { useAuthStore } from '../stores/auth.js'
import Message from '../components/Message.vue'

export default {
    data() {
        return {
            checkChoice: false,
            textStateQrcode: 'SONNETTE \n\r (Désactivé)',
            statusQrcode: true,
            etatQrcodeAnonymous: true,
            etatDringDringAnonymous: true,
            etatQrcode: true,
            etatDringDring: true,
            timerDringDring: 0,
            denomination: '',
            telephone: '',
            getPropriete: {},
            isVisibilityMessage: false,
            isTypeMessage: 'success',
            isMessage: ''
        }
    },
    mounted() {
        this.getData()
    },
    methods: {
        getData() {

            let idPropriete = this.$route.params.id

            // const authStore = useAuthStore();
            // const token = authStore.token;

            fetch('/api/auth/showProprieteNoLogin', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
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
                        if(data.result.status == 1){
                            this.statusQrcode = false
                        } else {
                            this.statusQrcode = true
                        }
                        this.getPropriete = data.result
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
        bascule(stateBascule) {
            if(stateBascule && !this.checkChoice){
                this.checkChoice = true
            } else if(!stateBascule && this.checkChoice ) {
                this.checkChoice = false
            }
        },  
        dringdring(anonymous) {

            let id = this.$route.params.id
            let denomination
            let telephone

            if(anonymous){

                denomination = "Inconnu"
                telephone = "Inconnu"
                // this.etatQrcodeAnonymous = false
                this.etatQrcodeAnonymous = true
                this.etatDringDringAnonymous = false;


            } else {

                denomination = this.denomination
                telephone = this.telephone

                if(!this.checkRequiredField("NOM", denomination)) return;
                if(!this.checkRequiredField("TELEPHONE", telephone)) return;
                this.etatQrcode = false

            }

            // this.textStateQrcode = 'Patientez...'

            // const authStore = useAuthStore();
            // const token = authStore.token;

            fetch('/api/auth/scan', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: id,
                    denomination: denomination,
                    telephone: telephone
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

                        if(anonymous){
                            // this.etatQrcodeAnonymous = true

                            this.timerDringDring = 10; // Démarrez le compteur à 10 secondes
                            // this.etatDringDringAnonymous = false;
                            const intervalId = setInterval(() => {
                            if (this.timerDringDring === 0) {
                                clearInterval(intervalId); // Arrêtez le compteur lorsque les 10 secondes sont écoulées
                                this.etatDringDringAnonymous = true; // Réactivez le bouton
                            } else {
                                this.timerDringDring--; // Décrémentez le compteur d'une seconde chaque seconde
                            }
                            }, 1000); // Répétez toutes les 1000 ms (1 seconde)

                        } else {
                            this.etatQrcode = true
                        }

                        // this.textStateQrcode = 'Désactivé...'

                        this.isVisibilityMessage = true 
                        this.isTypeMessage = "success"
                        this.isMessage = 'Votre visite a bien été notifié.'

                        setTimeout(() => {
                            this.isVisibilityMessage = false;
                        }, 3000);

                    } else {
                        this.etatQrcodeAnonymous = true
                        this.etatDringDringAnonymous = true;
                        this.etatQrcode = true
                        this.etatDringDring = true;
                        // this.textStateQrcode = 'SONNER'

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
    components: { Message }
}

</script>