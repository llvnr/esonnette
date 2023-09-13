<template>

    <div class="ShellDashboard">

        <div class="ShellDashboard__content">

            <div class="ShellDashboard__content-body">

                <div class="ShellCode">

                    <div class="ShellCode__image">
                        <img src="assets/images/logo_color.png" width="350" class="ShellCode__title" />
                    </div>

                    <form class="Shellogin__form" @submit.prevent="login">

                        <input type="number" step="1" class="ShellCode__email" v-model="code" placeholder="Votre code de confirmation...">

                        <button type="submit" class="ShellCode__btnlogin">Connexion</button>

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
            code: ''
        }
    },
    methods: {
        login() {
            fetch('/api/auth/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    email: localStorage.getItem('email'),
                    code: this.code
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
                console.log(data.access_token)
                console.log(data.user)

                localStorage.setItem("token", data.access_token)

                window.location.assign('/');

                // this.$router.push('/')

            })
            .catch(error => console.log(error));
        }
    },
    components: { Header }

}

</script>