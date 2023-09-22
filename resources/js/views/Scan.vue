<template>
    <div class="ShellScan">
        <div class="ShellScan__Header">Bienvenue chez</div>
        <div class="ShellScan__Body">
            <div class="ShellScan__Body-Title">{{ getPropriete.prenom + ' ' + getPropriete.nom }}</div>
            <Message :visibility="isVisibilityMessage" :type="isTypeMessage" :message="isMessage" />
            <div class="ShellScan__Body-Content">

                <div class="ShellScan__Body-Content-label">Qui êtes vous ?</div>
                <input type="text" class="ShellBody__Body-Content-input-name" v-model="denomination" placeholder="Votre nom ou entreprise" />
                <input type="text" class="ShellBody__Body-Content-input-telephone" v-model="telephone" placeholder="Votre numéro de téléphone" />
                <div class="ShellScan__Body-Content-infospub">
                    Besoin d'une sonnette comme ça chez vous ? <br> Rendez-vous sur 
                    <a href="https://esonnette.com" target="_blank">https://esonnette.com</a>
                </div>

            </div>
        </div>
        <div class="ShellScan__Footer ShellScan__Footer-desactivatebtn" v-if="!etatQrcode">SONNETTE <br>(Désactivé)</div>
        <div class="ShellScan__Footer ShellScan__Footer-disablebtn" v-else-if="etatQrcode && !etatDringDring">SONNER ({{ timerDringDring }}s)</div>
        <div class="ShellScan__Footer ShellScan__Footer-enablebtn" v-else-if="etatQrcode && etatDringDring" @click="this.dringdring">SONNER</div>
    </div>
</template>

<script>

import Message from '../components/Message.vue'

export default {
    data() {
        return {
            etatQrcode: null,
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
                        if(data.result.status == 1){
                            this.etatQrcode = true
                        } else {
                            this.etatQrcode = false
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
        dringdring() {

            let id = this.$route.params.id
            let denomination = this.denomination
            let telephone = this.telephone

            if(!this.checkRequiredField("NOM", denomination)) return;
            if(!this.checkRequiredField("TELEPHONE", telephone)) return;

            const token = localStorage.getItem('token');

            fetch('/api/auth/scan', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
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

                        this.timerDringDring = 10; // Démarrez le compteur à 10 secondes
                        this.etatDringDring = false;
                        const intervalId = setInterval(() => {
                        if (this.timerDringDring === 0) {
                            clearInterval(intervalId); // Arrêtez le compteur lorsque les 10 secondes sont écoulées
                            this.etatDringDring = true; // Réactivez le bouton
                        } else {
                            this.timerDringDring--; // Décrémentez le compteur d'une seconde chaque seconde
                        }
                        }, 1000); // Répétez toutes les 1000 ms (1 seconde)

                        this.isVisibilityMessage = true 
                        this.isTypeMessage = "success"
                        this.isMessage = 'Votre visite a bien été notifié.'

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
    components: { Message }
}

</script>