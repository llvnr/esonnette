<template>

    <div class="ShellDashboard__content">

        <div class="ShellDashboard__content-header">

            <Header />

        </div>
        <div class="ShellDashboard__content-body">

            <div class="ContentBodyVoirPropriete">

                <div class="ContentBodyVoirPropriete__content">
                    <div class="ContentBodyVoirPropriete__content-colonneUn">

                        <div class="ContentColonneUn__Card">
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

                        <button class="ContentColonneUn__btn-enableqr">Activer le QrCode</button>

                    </div>
                    <div class="ContentBodyVoirPropriete__content-colonneDeux">

                        <div class="ContentColonneDeux__Card">

                            <div class="ContentColonneDeux__label-image">
                                <img src="https://img.icons8.com/?size=100&id=13019&format=png" alt="">
                            </div>
                            <div class="ContentColonneDeux__label-content">
                                <div class="ContentColonneDeux__label-visite-total"><b>3</b> Visite(s) totale(s)</div>
                                <div class="ContentColonneDeux__label-visite-manquer"><b>2</b> Visite(s) manqué</div>
                                <div class="ContentColonneDeux__label-qrcode">Etat du QRCODE : <span class="ContentColonneDeux__label-etat-qrcode state-activate">Activé</span></div> 
                                
                            </div>

                        </div>

                        <button class="ContentColonneDeux__btn-disableqr">Désactiver le QrCode</button>

                    </div>
                </div>

                <div class="ContentBodyDataVisite">
                    
                    <div v-for="n in 10" class="cardVisite">

                        <div class="cardVisite__label-id">1</div>
                        <div class="cardVisite__label-image"><img src="https://img.icons8.com/?size=40&id=Hjmjz1QamXpz&format=png" alt=""></div>
                        <div class="cardVisite__label-date">29/08/2023</div>
                        <div class="cardVisite__label-heure">11:37</div>
                        <div class="cardVisite__label-name">Nom ou nom d'entreprise</div>
                        <div class="cardVisite__label-type">Type : Email / Discord / Sms</div>
                        <div class="cardVisite__label-status">Statut</div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</template>

<script setup>

import Header from "../components/Header.vue";

</script>