<template>

    <div class="ShellDashboard">

        <div class="ShellDashboard__content">

            <div class="ShellDashboard__content-body">

                <div class="ShellCode">

                    <div class="ShellCode__image">
                        <img src="assets/images/logo_color.png" width="350" class="ShellCode__title" />
                    </div>

                    <Message :visibility="isVisibilityMessage" :type="isTypeMessage" :message="isMessage" />

                    <form class="Shellogin__form" @submit.prevent="handleLogin">

                        <input type="number" step="1" class="ShellCode__email" v-model="code" placeholder="Votre code de confirmation...">

                        <button type="submit" class="ShellCode__btnlogin">Connexion</button>

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
            code: '',
            isVisibilityMessage: false,
            isTypeMessage: 'success',
            isMessage: ''
        }
    },
    methods: {
        async handleLogin() {

            // Obtenez une référence au store d'authentification
            const authStore = useAuthStore();

            const loginSuccessful = await authStore.login(this.code);
            if (loginSuccessful) {

                this.$router.push('/')

            } else {
                this.isVisibilityMessage = true 
                this.isTypeMessage = "danger"
                this.isMessage = "Connexion impossible."

                setTimeout(() => {
                    this.isVisibilityMessage = false;
                }, 2500);
            }

        }
    },
    components: { Header, Message }

}

</script>