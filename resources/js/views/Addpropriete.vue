<template>

    <div class="ShellDashboard__content">

        <div class="ShellDashboard__content-header">

            <Header title="Création d'une propriété" />

        </div>
        <div class="ShellDashboard__content-body">

            <div class="ContentBodyADDPropriete">

                <div class="ContentBodyADDPropriete__label-name">Nom du propriétaire</div>
                <input type="text" class="ContentBodyADDPropriete__input-name" v-model="nom" placeholder="Nom du propriétaire">

                <div class="ContentBodyADDPropriete__label-surname">Prénom du propriétaire</div>
                <input type="text" class="ContentBodyADDPropriete__input-surname" v-model="prenom" placeholder="Prénom du propriétaire">

                <div class="ContentBodyADDPropriete__label-type">Type de propriété</div>
                <select class="ContentBodyADDPropriete__select-type" v-model="typepropriete">
                    <option value="Maison">Maison</option>
                    <option value="Appartement">Appartement</option>
                </select>

                <div class="ContentBodyADDPropriete__label-adresse">Adresse de la propriété</div>
                <input type="text" class="ContentBodyADDPropriete__input-adresse" v-model="adresse" placeholder="Adresse de la propriété">

                <div class="ContentBodyADDPropriete__label-codepostal">Code postal</div>
                <input type="text" class="ContentBodyADDPropriete__input-codepostal" v-model="codepostal" placeholder="Code postal">

                <div class="ContentBodyADDPropriete__label-ville">Ville</div>
                <input type="text" class="ContentBodyADDPropriete__input-ville" v-model="ville" placeholder="Ville">

                <button class="ContentBodyADDPropriete__btnadd" @click="this.addPropriete">Créer</button>

            </div>

        </div>

    </div>

</template>

<script>

import Header from '../components/Header.vue';

export default {
    data() {
        return {
            nom: '',
            prenom: '',
            typepropriete: 'Maison',
            adresse: '',
            codepostal: '',
            ville: ''
        }
    },
    methods: {
        addPropriete() {

            let nom = this.nom 
            let prenom = this.prenom
            let typepropriete = this.typepropriete
            let adresse = this.adresse
            let codepostal = this.codepostal
            let ville = this.ville

            if(nom.length == 0) return alert('Le champ [NOM] est obligatoire.')
            if(prenom.length == 0) return alert('Le champ [PRENOM] est obligatoire.')
            if(typepropriete.length == 0) return alert('Le champ [TYPE DE PROPRIETE] est obligatoire.')
            if(adresse.length == 0) return alert('Le champ [ADRESSE] est obligatoire.')
            if(codepostal.length == 0) return alert('Le champ [CODE POSTAL] est obligatoire.')
            if(ville.length == 0) return alert('Le champ [VILLE] est obligatoire.')

            alert('AJOUT PROPRIETE')
        }
    },
    components: { Header }
}

</script>