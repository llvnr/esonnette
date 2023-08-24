<template>

    <div class="ShellDashboard__content">

        <div class="ShellDashboard__content-header">

            <Header />

        </div>
        <div class="ShellDashboard__content-body">

            <div class="ContentBody">

                <div class="ContentBody__colonneUn">

                    <div class="ContentBody__colonneUn-label-username">Nom d'utilisateur *</div>
                    <input type="text" class="ContentBody__colonneUn-input-username" placeholder="Nom d'utilisateur">

                    <button class="ContentBody__colonneUn-btnmdf">Modifier</button>

                </div>
                <div class="ContentBody__colonneDeux">

                    <div class="ContentBody__colonneDeux-label-email">Adresse email * <small class="ContentBody__colonneDeux-confirmation account-status-success">Non confirmé</small></div>
                    <input type="email" class="ContentBody__colonneDeux-input-email" placeholder="Votre adresse email">

                    <button class="ContentBody__colonneDeux-btnmdf">Modifier</button>

                </div>

            </div>

        </div>

    </div>

</template>

<script setup>

import Header from "../components/Header.vue";

</script>