<template>

    <div class="ShellDashboard__content">

        <div class="ShellDashboard__content-header">

            <Header title="Code de confirmation" :isLogging="false" />

        </div>
        <div class="ShellDashboard__content-body">

            <div class="ShellCode">

                <div class="ShellCode__image">
                    <img src="assets/images/logo_color.png" width="350" class="ShellCode__title" />
                </div>

                <input type="number" step="1" class="ShellCode__email" placeholder="Votre code de confirmation...">

                <button class="ShellCode__btnlogin">Connexion</button>

            </div>

        </div>

    </div>

</template>

<script setup>

import Header from "../components/Header.vue";

</script>