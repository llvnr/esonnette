<template>

    <div class="ShellDashboard__content">

        <div class="ShellDashboard__content-header">

            <Header />

        </div>
        <div class="ShellDashboard__content-body">

            <div class="ContentBodyVoirPropriete">

                <div class="ContentBodyVoirPropriete__content">
                    <div class="ContentBodyVoirPropriete__content-colonneUn">

                        <div class="ContentColonneUn__label-image">
                            <img src="https://img.icons8.com/?size=100&id=np6r5nc6uNNj&format=png" alt="">
                        </div>
                        <div class="ContentColonneUn__label-content">
                            <div class="ContentColonneUn__label-fullname">Ludovic LEVENEUR</div>
                            <div class="ContentColonneUn__label-adresse">56 bis chemin du ruisseau</div>
                            <div class="ContentColonneUn__label-codepostal">97421</div>
                            <div class="ContentColonneUn__label-ville">La rivière</div>
                        </div>

                    </div>
                    <div class="ContentBodyVoirPropriete__content-colonneDeux">

                        <div class="ContentColonneDeux__label-visite-total"><b>3</b> Visite(s) totale(s)</div>
                        <div class="ContentColonneDeux__label-visite-manquer"><b>2</b> Visite(s) manqué</div>
                        <button class="ContentColonneDeux__btn-enableqr">Activer le QrCode</button>
                        <button class="ContentColonneDeux__btn-disableqr">Désactiver le QrCode</button>

                    </div>
                </div>


                <!-- {{-- <div class="ContentBodyADDPropriete__label-name">Nom du propriétaire</div>

                <div class="ContentBodyADDPropriete__label-surname">Prénom du propriétaire</div>

                <div class="ContentBodyADDPropriete__label-type">Type de propriété</div>
                
                <div class="ContentBodyADDPropriete__label-adresse">Adresse de la propriété</div>

                <div class="ContentBodyADDPropriete__label-codepostal">Code postal</div>

                <div class="ContentBodyADDPropriete__label-ville">Ville</div> --}} -->

            </div>

        </div>

    </div>

</template>

<script setup>

import Header from "../components/Header.vue";

</script>