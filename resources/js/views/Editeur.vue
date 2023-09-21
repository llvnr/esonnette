<template>

    <div v-if="!loadData" class="ShellLoader">
        <Loader />
    </div>
    <div v-else class="ShellDashboard">

        <Sidebar />

        <div class="ShellDashboard__content">

            <div class="ShellDashboard__content-header">

                <Header title="Editeur de Sticker" />

            </div>
            <div class="ShellDashboard__content-body">

                <div class="ShellEditeur">

                    <Message :visibility="isVisibilityMessageOne" :type="isTypeMessageOne" :message="isMessageOne" />

                    <div class="ShellEditeur__left">

                        <div class="Sticker" id="sticker">

                            <div class="Sticker__text" id="stickerText">Pour Sonner</div>
                            <div class="Sticker__subtext" id="stickerSubtext">Scannez-moi !</div>
                            <img class="Sticker__qrcode" id="stickerQrcode" src="data:image/png;base64,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" />
                            <div class="Sticker__separation" id="stickerSeparation"></div>
                            <img class="Sticker__logo" id="stickerLogo" src="assets/images/logo_color.png" />
                            <p class="Sticker__signature" id="stickerSignature">Ce service est proposé par esonnette.com.</p>

                        </div>

                    </div>
                    <div class="ShellEditeur__right">

                        <div class="ShellEditeur__right-labelpropriete">Mes propriétés : </div>
                        <select v-for="(item, index) in proprietes" v-model="myProperty" class="ShellEditeur__right-selectpropriete">
                            <option :value="item.id">{{ "#" + item.id + ' - ' + item.prenom + ' ' + item.nom + ' (' + item.adresse + ' ' + item.codepostal + ' ' + item.ville + ')' }}</option>
                        </select>

                        <hr>

                        <div class="ShellEditeur__right-labelborder">Bordure : </div>
                        <input type="color" class="ShellEditeur__right-inputborder" @change="changeStyleSticker" v-model="border" />

                        <div class="ShellEditeur__right-labelbackground">Couleur de fond : </div>
                        <input type="color" class="ShellEditeur__right-inputbackground" @change="changeStyleSticker" v-model="background" />

                        <div class="ShellEditeur__right-labeltitle">Titre : </div>
                        <input type="color" class="ShellEditeur__right-inputtitle" @change="changeStyleSticker" v-model="title" />

                        <div class="ShellEditeur__right-labelsubtitle">Sous Titre : </div>
                        <input type="color" class="ShellEditeur__right-inputsubtitle" @change="changeStyleSticker" v-model="subtitle" />

                        <div class="ShellEditeur__right-labelbackgroundqrcode">Couleur de fond Qr Code : </div>
                        <input type="color" class="ShellEditeur__right-inputbackgroundqrcode" @change="changeStyleSticker" v-model="backgroundQrcode" />

                        <div class="ShellEditeur__right-labelcolorqrcode">Couleur Qr Code : </div>
                        <input type="color" class="ShellEditeur__right-inputcolorqrcode" @change="changeStyleSticker" v-model="colorQrcode" />

                        <div class="ShellEditeur__right-labelseparation">Séparation : </div>
                        <input type="color" class="ShellEditeur__right-inputseparation" @change="changeStyleSticker" v-model="separation" />

                        <div class="ShellEditeur__right-labelsignature">Signature : </div>
                        <input type="color" class="ShellEditeur__right-inputsignature" @change="changeStyleSticker" v-model="signature" />

                        <br>

                        <button class="ShellEditeur__right-btnupdate">Modifier</button>

                    </div>
                </div>

            </div>

        </div>
    </div>

</template>

<script>

import Loader from '../components/Loader.vue';
import Header from '../components/Header.vue';
import Sidebar from '../components/Sidebar.vue';
import Message from '../components/Message.vue';

export default {
    data() {
        return {
            isVisibilityMessageOne: false,
            isTypeMessageOne: 'danger',
            isMessageOne: "",
            loadData: true,
            proprietes: {},
            myProperty: null,
            border: '#000000',
            background: '#FFFFFF',
            title: '#3056D3',
            subtitle: '#000000',
            backgroundQrcode: '#FFFFFF',
            colorQrcode: '#FFFFFF',
            separation: '#000000',
            signature: '#000000'
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
                        if(data.result.length != 0){
                            // this.dataIsOkay = true
                            this.proprietes = data.result
                            this.myProperty = data.result[0].id
                            this.getSticker()
                            // this.loadData = true
                        }
                    } else {
                        this.isVisibilityMessageOne = true 
                        this.isTypeMessageOne = "danger"
                        this.isMessageOne = data.message

                        setTimeout(() => {
                            this.isVisibilityMessageOne = false;
                        }, 3000);
                    }
                }
            })
            .catch(error => console.log(error));

        },
        getSticker() {

            let idPropriete = this.myProperty

            const token = localStorage.getItem('token');

            fetch('/api/auth/getSticker', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
                body: JSON.stringify({
                    idPropriete: idPropriete
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
                        // console.log(data)
                        if(data.result.length != 0){
                            // this.dataIsOkay = true
                            // this.proprietes = data.result
                            // this.loadData = true

                            console.log(data)
                            let configuration = JSON.parse(data.result.configuration)
                            this.border = configuration.border
                            this.background = configuration.background
                            this.title = configuration.title
                            this.subtitle = configuration.subtitle
                            this.backgroundQrcode = configuration.backgroundQrcode
                            this.colorQrcode = configuration.colorQrcode
                            this.separation = configuration.separation
                            this.signature = configuration.signature

                            let sticker = document.getElementById("sticker")
                            sticker.style.border = "1px solid" + this.border
                            sticker.style.backgroundColor = this.background
                            let stickerText = document.getElementById("stickerText")
                            stickerText.style.color = this.title
                            let stickerSubtext = document.getElementById("stickerSubtext")
                            stickerSubtext.style.color = this.subtitle
                            let stickerQrcode = document.getElementById("stickerQrcode")
                            let stickerSeparation = document.getElementById("stickerSeparation")
                            stickerSeparation.style.borderBottom = "4px solid " + this.separation
                            let stickerLogo = document.getElementById("stickerLogo")
                            let stickerSignature = document.getElementById("stickerSignature")
                            stickerSignature.style.color = this.signature

                            // console.log(configuration)

                        }
                    } else {
                        this.isVisibilityMessageOne = true 
                        this.isTypeMessageOne = "danger"
                        this.isMessageOne = data.message

                        setTimeout(() => {
                            this.isVisibilityMessageOne = false;
                        }, 3000);
                    }
                }
            })
            .catch(error => console.log(error));

        },
        changeStyleSticker() {

            let border = this.border 
            let background = this.background
            let title = this.title 
            let subtitle = this.subtitle
            let backgroundQrcode = this.backgroundQrcode
            let colorQrcode = this.colorQrcode
            let separation = this.separation
            let signature = this.signature

            let sticker = document.getElementById("sticker")
            sticker.style.border = "1px solid" + border
            sticker.style.backgroundColor = background
            let stickerText = document.getElementById("stickerText")
            stickerText.style.color = title
            let stickerSubtext = document.getElementById("stickerSubtext")
            stickerSubtext.style.color = subtitle
            let stickerQrcode = document.getElementById("stickerQrcode")
            let stickerSeparation = document.getElementById("stickerSeparation")
            stickerSeparation.style.borderBottom = "4px solid " + separation
            let stickerLogo = document.getElementById("stickerLogo")
            let stickerSignature = document.getElementById("stickerSignature")
            stickerSignature.style.color = signature

            // alert(border + ' / ' + background + ' / ' + 
            // backgroundQrcode + ' / ' + colorQrcode + ' / '
            // + separation)

        }
    },
    components: { Loader, Header, Sidebar, Message }
}

</script>