<template>

    <div class="ShellDashboard__content">

        <div class="ShellDashboard__content-header">

            <Header />

        </div>
        <div class="ShellDashboard__content-body">

            <div class="ContentBodyADDPropriete">

                <div class="ContentBodyADDPropriete__label-name">Nom du propriétaire</div>
                <input type="text" class="ContentBodyADDPropriete__input-name" placeholder="Nom du propriétaire">

                <div class="ContentBodyADDPropriete__label-surname">Prénom du propriétaire</div>
                <input type="text" class="ContentBodyADDPropriete__input-surname" placeholder="Prénom du propriétaire">

                <div class="ContentBodyADDPropriete__label-type">Type de propriété</div>
                <select class="ContentBodyADDPropriete__select-type">
                    <option value="Maison">Maison</option>
                    <option value="Appartement">Appartement</option>
                </select>

                <div class="ContentBodyADDPropriete__label-adresse">Adresse de la propriété</div>
                <input type="text" class="ContentBodyADDPropriete__input-adresse" placeholder="Adresse de la propriété">

                <div class="ContentBodyADDPropriete__label-codepostal">Code postal</div>
                <input type="text" class="ContentBodyADDPropriete__input-codepostal" placeholder="Code postal">

                <div class="ContentBodyADDPropriete__label-ville">Ville</div>
                <input type="text" class="ContentBodyADDPropriete__input-ville" placeholder="Ville">

                <button class="ContentBodyADDPropriete__btnadd">Créer</button>


            </div>

        </div>

    </div>

</template>

<script setup>

import Header from "../components/Header.vue";

</script>