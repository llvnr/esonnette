<template>

    <div class="ShellDashboard">

        <div class="ShellDashboard__content">

            <div class="ShellDashboard__content-body">

                <div class="Shellogin">

                    <div class="Shellogin__image">
                        <img src="assets/images/logo_color.png" width="350" class="Shellogin__title" />
                    </div>

                    <Message :visibility="isVisibilityMessage" :type="isTypeMessage" :message="isMessage" />

                    <form class="Shellogin__form" @submit.prevent="handleLogin">
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
import { ref } from 'vue';
import { useAuthStore } from '../stores/auth.js';

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
        async handleLogin() {

            this.isLoading = false

            // Obtenez une référence au store d'authentification
            const authStore = useAuthStore();

            const loginSuccessful = await authStore.chugc(this.email);

            if (loginSuccessful) {
                // Redirigez l'utilisateur ou effectuez d'autres actions en cas de succès
                this.isLoading = true

                this.isVisibilityMessage = true 
                this.isTypeMessage = "success"
                this.isMessage = "Un code de confirmation a été envoyer."

                setTimeout(() => {
                    this.isVisibilityMessage = false;
                    this.$router.push('/code')
                }, 3000);

            } else {
                // Affichez un message d'erreur ou effectuez d'autres actions en cas d'échec
                this.isLoading = true
                this.isVisibilityMessage = true 
                this.isTypeMessage = "danger"
                this.isMessage = "Une erreur est survenue à la connexion."

                setTimeout(() => {
                    this.isVisibilityMessage = false;
                }, 2500);
            }

        }
    },
    components: { Header, Message }
}

</script>