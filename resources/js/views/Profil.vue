<template>

    <div class="ShellDashboard">

        <Sidebar :isLogging="true" />

        <div class="ShellDashboard__content">

            <div class="ShellDashboard__content-header">

                <Header title="Page de profil" />

            </div>
            <div class="ShellDashboard__content-body">

                <Message :visibility="isVisibilityMessage" :type="isTypeMessage" :message="isMessage" />

                <div class="ContentBody">

                    <div class="ContentBody__colonneUn">

                        <div class="ContentBody__colonneUn-card">

                            <form class="UpdateAccountForm" @submit.prevent="updateAccount">

                                <input type="hidden" v-model="id" /> 

                                <div class="ContentBody__colonneUn-label-username">Nom d'utilisateur *</div>
                                <input type="text" class="ContentBody__colonneUn-input-username" v-model="username" placeholder="Nom d'utilisateur">

                                <div class="ContentBody__colonneUn-label-email">Adresse email * 
                                    <small v-if="accountConfirmed === null" class="ContentBody__colonneDeux-confirmation account-status-danger">Non confirmé</small>
                                    <small v-else class="ContentBody__colonneDeux-confirmation account-status-success">Confirmé</small>
                                </div>
                                <input type="email" class="ContentBody__colonneUn-input-email" v-model="email" placeholder="Votre adresse email">

                                <button class="ContentBody__colonneUn-btnmdf">Modifier</button>
                            </form>

                        </div>

                    </div>
                    <div class="ContentBody__colonneDeux">

                        <div class="ContentBody__colonneDeux-card">

                            <button v-if="accountConfirmed === null" class="ContentBody__colonneUn-btnconfirmed" @click="sendMailConfirmation" >Renvoyer l'email de confirmation</button>

                            <button class="ContentBody__colonneUn-btndelete">Supprimer mon compte</button>
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
            id: null,
            username: null,
            email: null,
            accountConfirmed: null,
            isVisibilityMessage: false,
            isTypeMessage: 'success',
            isMessage: ''
        }
    },
    mounted() {
        this.getProfile()
    },
    methods: {
        updateAccount(){
            let id = this.id
            let username = this.username 
            let email = this.email 

            if(!this.checkRequiredField("Nom d'utilisateur", username)) return;
            if(!this.checkRequiredField("Email", email)) return;

            const token = localStorage.getItem('token');

            fetch('/api/auth/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
                body: JSON.stringify({
                    id: id,
                    username: username,
                    email: email
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
                if(data.status){
                    this.username = data.data.username
                    this.email = data.data.email
                    this.accountConfirmed = data.data.email_verified_at

                    this.isVisibilityMessage = true 
                    this.isTypeMessage = "success"
                    this.isMessage = data.message

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
            })
            .catch(error => console.log(error));
        },  
        sendMailConfirmation() {
            alert("Cette fonctionnaité est en cours de développement...")
        },          
        getProfile() {
            const token = localStorage.getItem('token');

            fetch('/api/auth/user-profile', {
                method: 'GET',
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
                console.log(data)
                if(data !== undefined){
                    this.id = data.id
                    this.username = data.username
                    this.email = data.email
                    this.accountConfirmed = data.email_verified_at
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