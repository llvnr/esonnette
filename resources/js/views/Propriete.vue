<template>

    <div class="ShellDashboard__content">

        <div class="ShellDashboard__content-header">

            <Header />

        </div>
        <div class="ShellDashboard__content-body">

            <div class="ContentBodyPropriete">

                <div class="ContentBodyPropriete__colonneUn">
                    <router-link to="/addpropriete" class="noDecor"><button class="ContentBodyPropriete__colonneUn-btnPropriete">Nouveau</button></router-link>
                </div>
                <div class="ContentBodyPropriete__colonneDeux">
                    
                    <router-link to="/voir-propriete" class="noDecor">
                        <div class="cardPropriete">

                            <div class="cardPropriete__label-id">1</div>
                            <div class="cardPropriete__label-image"><img src="https://img.icons8.com/?size=40&id=13019&format=png" alt=""></div>
                            <div class="cardPropriete__label-name">Ludovic</div>
                            <div class="cardPropriete__label-surname">LEVENEUR</div>
                            <div class="cardPropriete__label-adresse">56 Bis chemin du ruisseau</div>
                            <div class="cardPropriete__label-codepostal">97421</div>
                            <div class="cardPropriete__label-ville">LA RIVIERE</div>
                            <div class="cardPropriete__label-visite">3 Visite(s)</div>

                        </div>
                    </router-link>
                    
                </div>

            </div>

        </div>

    </div>

</template>

<script setup>

import Header from "../components/Header.vue";

</script>