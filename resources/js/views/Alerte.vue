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
                            <option value="Email">Email</option>
                            <option value="Discord">Discord</option>
                            <option value="SMS">SMS (Indisponible)</option>
                            <option value="Slack">Slack (Indisponible)</option>
                        </select>
                        <button class="ContentBodyAlerte__colonneUn-btn">Nouveau</button>
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
            typeAlerte: "Email"
        }
    },
    methods: {
        goBack() {
            this.$router.go(-1)
        }
    },
    mounted() {
        this.getID = this.$route.params.id
    },
    components: { Header }
}

</script>