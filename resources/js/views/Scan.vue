<template>
    <div class="ShellScan">
        <div class="ShellScan__Header">Bienvenue chez</div>
        <div class="ShellScan__Body">
            <div class="ShellScan__Body-Title">{{ getPropriete.prenom + ' ' + getPropriete.nom }}</div>
            <div class="ShellScan__Body-Content">

                <div class="ShellScan__Body-Content-label">Qui êtes vous ?</div>
                <input type="text" class="ShellBody__Body-Content-input-name" v-model="denomination" placeholder="Votre nom ou entreprise" />
                <input type="text" class="ShellBody__Body-Content-input-telephone" v-model="telephone" placeholder="Votre numéro de téléphone" />
                <div class="ShellScan__Body-Content-infos">
                    Comment voulez vous sonner ?
                </div>
                <select class="ShellScan__Body-Content-Canaux" v-model="canaux">
                    <option value="Email">Via Email</option>
                    <option value="Discord">Via Discord</option>
                </select>
                <div class="ShellScan__Body-Content-infospub">
                    Besoin d'une sonnette comme ça chez vous ? <br> Rendez-vous sur 
                    <a href="https://yakelkun.equativa.com" target="_blank">https://yakelkun.equativa.com</a>
                </div>

            </div>
        </div>
        <div class="ShellScan__Footer" @click="this.dringdring">SONNER</div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            denomination: '',
            telephone: '',
            canaux: 'Email',
            getPropriete: {}
        }
    },
    mounted() {
        this.getData()
    },
    methods: {
        getData() {

            let idPropriete = this.$route.params.id

            const token = localStorage.getItem('token');

            fetch('/api/auth/showPropriete', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
                body: JSON.stringify({
                    id: idPropriete
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
                        this.getPropriete = data.result
                    } else {
                        alert(data.message)
                    }
                }
            })
            .catch(error => console.log(error));

        },
        dringdring() {

            let denomination = this.denomination
            let telephone = this.telephone
            let canaux = this.canaux 

            if(denomination.length === 0) return alert('Le champ [NOM] est obligatoire.')
            if(telephone.length === 0) return alert('Le champ [TELEPHONE] est obligatoire.')
            if(canaux.length === 0) return alert('Le champ [CANAUX] est obligatoire.')

            alert('dring dring !')
        }
    }
}

</script>