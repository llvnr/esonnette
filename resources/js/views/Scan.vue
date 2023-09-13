<template>
    <div class="ShellScan">
        <div class="ShellScan__Header">Bienvenue chez</div>
        <div class="ShellScan__Body">
            <div class="ShellScan__Body-Title">Ludovic LEVENEUR</div>
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
                    <a href="https://yakelkun.llvnr.com" target="_blank">https://yakelkun.llvnr.com</a>
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
            canaux: 'Email'
        }
    },
    methods: {
        dringdring() {
            alert('dring dring !')
        }
    }
}

</script>