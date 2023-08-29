<template>

    <div class="ShellDashboard__content">

        <div class="ShellDashboard__content-header">

            <Header title="Inscription" :isLogging="false" />

        </div>
        <div class="ShellDashboard__content-body">

            <div class="Shellregister">

                <div  class="Shellregister__image">
                    <img src="assets/images/logo_color.png" width="350" class="Shellregister__title" />
                </div>

                <input type="text" class="Shellregister__username" placeholder="Votre nom d'utilisateur...">

                <input type="email" class="Shellregister__email" placeholder="Votre adresse email...">

                <button class="Shellregister__btnregister">Inscription</button>

            </div>

        </div>

    </div>

</template>

<script setup>

import Header from "../components/Header.vue";

</script>