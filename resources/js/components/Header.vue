<template>

    <div class="ContentHeader">

        <div class="ContentHeader__colonneLeft">
            <div class="ContentHeader__colonneLeft-title">{{ title  }}</div>
        </div>
        <div class="ContentHeader__colonneRight">

            <ul v-if="isLogging" class="ContentHeader__colonneRight-navigation">
                <router-link to="/profil" class="noDecor"><li class="ContentHeader__colonneRight-navigation-element">Mon profil</li></router-link>
                <li class="ContentHeader__colonneRight-navigation-element"><i class="bi bi-brightness-high-fill"></i></li>
            </ul>
            <ul v-else class="ContentHeader__colonneRight-navigation">
                <li class="ContentHeader__colonneRight-navigation-element"><i class="bi bi-brightness-high-fill"></i></li>
            </ul>

        </div>

    </div>

</template>

<script>
export default {
    props: ['title'],
    data() {
        return {
            isLogging: false
        }
    },
    mounted() {
        this.checkIsLogging()
    },
    methods: {
        checkIsLogging() {

            const token = localStorage.getItem('token');

            fetch('/api/auth/user-profile', {
                method: 'GET',
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
                if(data == undefined){
                    this.isLogging = false
                } else {
                    this.isLogging = true
                }

            })
            .catch(error => console.log(error));

        }
    }
};

</script>