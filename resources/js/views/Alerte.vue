<template>
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
                    
                    <div class="cardAlerte noDecor">

                        <div class="cardAlerte__label-id">1</div>
                        <div class="cardAlerte__label-logo">LOGO</div>
                        <div class="cardAlerte__label-type">TYPE</div>
                        <div class="cardAlerte__label-informations">INFOS</div>
                        <div class="cardAlerte__label-etat">ETAT</div>
                        <div class="cardAlerte__label-action">Voir - Modifier - Delete</div>

                    </div>

                    <div class="cardAlerte noDecor">

                        <div class="cardAlerte__label-id">1</div>
                        <div class="cardAlerte__label-logo">LOGO</div>
                        <div class="cardAlerte__label-type">TYPE</div>
                        <div class="cardAlerte__label-informations">INFOS</div>
                        <div class="cardAlerte__label-etat">ETAT</div>
                        <div class="cardAlerte__label-action">Voir - Modifier - Delete</div>

                    </div>
                    
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
            getID: null,
            typeAlerte: "email"
        }
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
        }
    },
    mounted() {
        this.getID = this.$route.params.id
    },
    components: { Header }
}

</script>