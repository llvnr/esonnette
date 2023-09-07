<template>

    <div class="ShellDashboard__content">

        <div class="ShellDashboard__content-header">

            <Header title="Mes propriétés" />

        </div>
        <div class="ShellDashboard__content-body">

            <div class="ContentBodyPropriete">

                <div class="ContentBodyPropriete__colonneUn">
                    <router-link to="/addpropriete" class="noDecor"><button class="ContentBodyPropriete__colonneUn-btnPropriete">Nouveau</button></router-link>
                </div>
                <div class="ContentBodyPropriete__colonneDeux">
                    
                    <router-link :to="'/voir-propriete/' + item.id" v-for="(item, index) in proprietes" class="cardPropriete noDecor">

                        <div class="cardPropriete__label-id">{{ item.id }}</div>
                        <div class="cardPropriete__label-image"><img :src="item.qrcode" width="50" /></div>
                        <div class="cardPropriete__label-name">{{ item.nom }}</div>
                        <div class="cardPropriete__label-surname">{{ item.prenom }}</div>
                        <div class="cardPropriete__label-adresse">{{ item.adresse }}</div>
                        <div class="cardPropriete__label-codepostal">{{ item.codepostal }}</div>
                        <div class="cardPropriete__label-ville">{{ item.ville }}</div>
                        <div class="cardPropriete__label-visite">0 Visite(s)</div>

                    </router-link>
                    
                </div>

            </div>

        </div>

    </div>

</template>

<script>

import Header from '../components/Header.vue';

export default {
    data() {
        return {
            proprietes: null
        }
    },
    mounted() {
        this.getPropriete()
    },
    methods: {
        getPropriete() {
            
            const token = localStorage.getItem('token');

            fetch('/api/auth/allPropriete', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                }
            })
            .then(response => {
                // Gérer la réponse ici, si nécessaire
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Erreur de réponse du serveur');
                }
            })
            .then(data => {
                if(data !== undefined){
                    if(data.status){
                        // console.log(data)
                        this.proprietes = data.result
                    } else {
                        alert(data.message)
                    }
                }
            })
            .catch(error => console.log(error));

        }
    },  
    components: { Header }
}

</script>