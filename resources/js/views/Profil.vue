<template>

    <div class="ShellDashboard__content">

        <div class="ShellDashboard__content-header">

            <Header title="Page de profil" />

        </div>
        <div class="ShellDashboard__content-body">

            <div class="ContentBody">

                <div class="ContentBody__colonneUn">

                    <div class="ContentBody__colonneUn-card">

                        <div class="ContentBody__colonneUn-label-username">Nom d'utilisateur *</div>
                        <input type="text" class="ContentBody__colonneUn-input-username" v-model="username" placeholder="Nom d'utilisateur">

                        <div class="ContentBody__colonneUn-label-email">Adresse email * 
                            <small v-if="accountConfirmed === null" class="ContentBody__colonneDeux-confirmation account-status-danger">Non confirmé</small>
                            <small v-else class="ContentBody__colonneDeux-confirmation account-status-success">Confirmé</small>
                        </div>
                        <input type="email" class="ContentBody__colonneUn-input-email" v-model="email" placeholder="Votre adresse email">

                        <button class="ContentBody__colonneUn-btnmdf">Modifier</button>

                    </div>

                    <div class="ContentBody__colonneUn-card">
                        <button class="ContentBody__colonneUn-btndelete">Supprimer mon compte</button>
                    </div>

                </div>
                <div class="ContentBody__colonneDeux">



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
            username: null,
            email: null,
            accountConfirmed: null
        }
    },
    mounted() {
        this.getProfile()
    },
    methods: {

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
                    this.username = data.username
                    this.email = data.email
                    this.accountConfirmed = data.email_verified_at
                }
            })
            .catch(error => console.log(error));

        }
    },
    components: { Header }

}

</script>