<template>

    <div class="ShellDashboard">

        <Sidebar :isLogging="true" />

        <div class="ShellDashboard__content">

            <div class="ShellDashboard__content-header">

                <Header title="Gestion des alertes" />

            </div>
            <div class="ShellDashboard__content-body">

                <div class="ContentBodyAlerte">

                    <div class="ContentBodyAlerte__colonneUn">
                        <div class="ContentBodyAlerte__colonneUn-cUn">
                        <button @click="goBack" class="ContentBodyAlerte__colonneUn-btnBack">Retour</button>
                        </div>
                        <div class="ContentBodyAlerte__colonneUn-cDeux">
                            <select class="ContentBodyAlerte__select-type" v-model="typeAlerte">
                                <option value="email">Email</option>
                                <option value="discord">Discord</option>
                                <option value="sms">SMS (Indisponible)</option>
                                <option value="slack">Slack (Indisponible)</option>
                            </select>
                            <button class="ContentBodyAlerte__colonneUn-btn" @click="goAddAlert">Nouveau</button>
                        </div>
                    </div>
                    <div class="ContentBodyAlerte__colonneDeux">
                        
                        <div v-for="(item, index) in allAlerte" class="cardAlerte noDecor">

                            <div class="cardAlerte__label-id">{{ item.id }}</div>
                            <div v-if="item.type === 'email'" class="cardAlerte__label-logo"><img src="https://img.icons8.com/?size=25&id=D9x0PpvvT1AL&format=png" /></div>
                            <div v-else-if="item.type === 'discord'" class="cardAlerte__label-logo"><img src="https://img.icons8.com/?size=25&id=30998&format=png" /></div>
                            <div v-else-if="item.type === 'slack'" class="cardAlerte__label-logo">LOGO</div>
                            <div v-else-if="item.type === 'sms'" class="cardAlerte__label-logo">LOGO</div>
                            <div class="cardAlerte__label-type">{{ item.type }}</div>
                            <!-- <div class="cardAlerte__label-informations">{{ item.informations.substring(0, 21) }}</div> -->
                            <div class="cardAlerte__label-etat">{{ item.etat }}</div>
                            <div class="cardAlerte__label-action">Voir - Modifier - Delete</div>

                        </div>
                        
                    </div>

                </div>

            </div>

        </div>

    </div>
 
</template>

<script>

import Sidebar from '../components/Sidebar.vue';
import Header from '../components/Header.vue';

export default {
    data() {
        return {
            getID: null,
            typeAlerte: "email",
            allAlerte: {}
        }
    },
    mounted() {
        this.getID = this.$route.params.id
        this.getAlerte()
    },
    methods: {
        goBack() {
            this.$router.go(-1)
        },
        goAddAlert() {
            let typeAlert = this.typeAlerte
            if(typeAlert === "sms" || typeAlert === "slack"){
                alert('INDISPONIBLE POUR LE MOMENT.')
            } else {
                this.$router.push('/alerte/add/' + typeAlert + '/' + this.getID)
            }
        },
        getAlerte() {

            const token = localStorage.getItem('token');

            fetch('/api/auth/getAlerte', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
                body: JSON.stringify({
                    id: this.getID
                })
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
                        this.allAlerte = data.result
                    } else {
                        alert(data.message)
                    }
                }
            })
            .catch(error => console.log(error));

        }
    },
    components: { Sidebar, Header }
}

</script>