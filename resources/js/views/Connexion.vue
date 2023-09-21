<template>

    <div class="ShellDashboard">

        <div class="ShellDashboard__content">

            <div class="ShellDashboard__content-body">

                <div class="Shellogin">

                    <div class="Shellogin__image">
                        <img src="assets/images/logo_color.png" width="350" class="Shellogin__title" />
                    </div>

                    <Message :visibility="isVisibilityMessage" :type="isTypeMessage" :message="isMessage" />

                    <form class="Shellogin__form" @submit.prevent="login">
                        <input type="email" class="Shellogin__email" name="email" v-model="email" placeholder="Votre adresse email...">

                        <button type="submit" v-if="!isLoading" class="Shellogin__btnlogin-disabled" :disabled="!isLoading">Patientez...</button>
                        <button type="submit" v-else class="Shellogin__btnlogin">Connexion</button>
                    </form>
                </div>

            </div>

        </div>

    </div>

</template>

<script>
import Message from '../components/Message.vue';
import Header from '../components/Header.vue';

export default {
    data() {
        return {
            isLoading: true,
            email: '',
            isVisibilityMessage: false,
            isTypeMessage: 'success',
            isMessage: ''
        };
    },
    methods: {
        login() {

            this.isLoading = false

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
                    // console.log(data.message)
                    console.log(data.code)

                    this.isLoading = true

                    this.isVisibilityMessage = true 
                    this.isTypeMessage = "success"
                    this.isMessage = data.message

                    setTimeout(() => {
                        this.isVisibilityMessage = false;
                        localStorage.setItem("email", this.email)

                        this.$router.push('/code')
                    }, 3000);

                } else {
                    this.isLoading = true
                    this.isVisibilityMessage = true 
                    this.isTypeMessage = "danger"
                    this.isMessage = data.message

                    setTimeout(() => {
                        this.isVisibilityMessage = false;
                    }, 2500);
                }
            })
            .catch(error => console.log(error));
        }
    },
    components: { Header, Message }
}

</script>