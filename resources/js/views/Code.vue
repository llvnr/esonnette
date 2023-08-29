<template>

    <div class="ShellDashboard__content">

        <div class="ShellDashboard__content-header">

            <Header title="Code de confirmation" />

        </div>
        <div class="ShellDashboard__content-body">

            <div class="Shellogin">

                <div class="Shellogin__image">
                    <img src="assets/images/logo_color.png" width="350" class="Shellogin__title" />
                </div>

                <input type="number" step="1" class="Shellogin__email" placeholder="Votre code de confirmation...">

                <button class="Shellogin__btnlogin">Connexion</button>

            </div>

        </div>

    </div>

</template>

<script setup>

import Header from "../components/Header.vue";

</script>