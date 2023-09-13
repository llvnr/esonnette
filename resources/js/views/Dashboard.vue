<template>

    <div class="ShellDashboard">

        <Sidebar />

        <div class="ShellDashboard__content">

            <div class="ShellDashboard__content-header">

                <Header title="Dashboard" />

            </div>
            <div class="ShellDashboard__content-body">

                <div class="ContentBody__row">

                    <div class="ContentBody__row-card">
                        <div class="ContentBody__row-card-title">Content de vous revoir !</div>
                        <div class="ContentBody__row-card-infos">
                            Ici vous pouvez voir toutes les données importantes en un seul endroit !
                        </div>
                    </div>

                    <div class="ContentBody__row-card">
                        <div class="ContentBody__row-card-counter">{{ utilisateur }}</div>
                        <div class="ContentBody__row-card-title">Utilisateur(s)</div>
                        <div class="ContentBody__row-card-infos">
                            Comptabilise le nombre d'utilisateurs qui sont dans cette instance.
                        </div>
                    </div>

                    <div class="ContentBody__row-card">
                        <div class="ContentBody__row-card-counter">{{ role }}</div>
                        <div class="ContentBody__row-card-title">Rôle(s)</div>
                        <div class="ContentBody__row-card-infos">
                            Comptabilise le nombre de rôle qui sont dans cette instance.
                        </div>
                    </div>

                    <div class="ContentBody__row-card">
                        <div class="ContentBody__row-card-counter">{{ propriete }}</div>
                        <div class="ContentBody__row-card-title">Propriétés</div>
                        <div class="ContentBody__row-card-infos">
                            Comptabilise le nombre de propriétés associé à cette instance.
                        </div>
                    </div>

                    <div class="ContentBody__row-card">
                        <div class="ContentBody__row-card-counter">15</div>
                        <div class="ContentBody__row-card-title">Visite(s) totale(s)</div>
                        <div class="ContentBody__row-card-infos">
                            Comptabilise le nombre de visite reçu sur l'ensemble des propriétés.
                        </div>
                    </div>

                    <div class="ContentBody__row-card">
                        <div class="ContentBody__row-card-counter">25</div>
                        <div class="ContentBody__row-card-title">Visite(s) manqué(s)</div>
                        <div class="ContentBody__row-card-infos">
                            Comptabilise le nombre de visite manqué sur l'ensemble des propriétés.
                        </div>
                    </div>

                    <div class="ContentBody__row-card">
                        <div class="ContentBody__row-card-counter">35</div>
                        <div class="ContentBody__row-card-title">Alerte(s) email(s)</div>
                        <div class="ContentBody__row-card-infos">
                            Comptabilise le nombre d'alertes par email envoyées sur l'ensemble des propriétés.
                        </div>
                    </div>

                    <div class="ContentBody__row-card">
                        <div class="ContentBody__row-card-counter">45</div>
                        <div class="ContentBody__row-card-title">Alerte(s) discord</div>
                        <div class="ContentBody__row-card-infos">
                            Comptabilise le nombre d'alertes discord envoyés sur l'ensemble des propriétés.
                        </div>
                    </div>

                    <div class="ContentBody__row-card">
                        <div class="ContentBody__row-card-counter">55</div>
                        <div class="ContentBody__row-card-title">Alerte(s) SMS</div>
                        <div class="ContentBody__row-card-infos">
                            Comptabilise le nombre d'alertes SMS envoyés sur l'ensemble des propriétés.
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
    data(){
        return {
            utilisateur: null,
            role: null,
            propriete: null
        }
    },
    mounted() {
        this.initDashboard()
    },
    methods: {
        initDashboard() {
            const token = localStorage.getItem('token');

            fetch('/api/auth/getDashboard', {
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
                console.log(data)
                if(data !== undefined){
                    if(data.status){
                        this.utilisateur = data.data.utilisateur
                        this.role = data.data.role
                        this.propriete = data.data.propriete
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