<template>

    <div class="ShellDashboard">

        <div class="ShellDashboard__content">

            <div class="ShellDashboard__content-body">

                <div class="Shellogin">

                    <div class="Shellogin__image">
                        <img src="assets/images/logo_color.png" width="350" class="Shellogin__title" />
                    </div>
                    <form class="Shellogin__form" @submit.prevent="login">
                        <input type="email" class="Shellogin__email" name="email" v-model="email" placeholder="Votre adresse email...">

                        <button type="submit" class="Shellogin__btnlogin">Connexion</button>
                    </form>
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
            email: ''
        };
    },
    methods: {
        login() {
            fetch('/api/auth/chugc', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    email: this.email
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
                    console.log(data.message)
                    console.log(data.code)

                    localStorage.setItem("email", this.email)

                    this.$router.push('/code')

                }
            })
            .catch(error => console.log(error));
        }
    },
    components: { Header }
}

</script>