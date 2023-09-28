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

                <Message :visibility="isVisibilityMessageOne" :type="isTypeMessageOne" :message="isMessageOne" />

                <div v-if="Object.keys(proprietes).length != 0" class="ShellEditeur">

                    <div class="ShellEditeur__left" id="ShellEditeur__left">

                        <div class="Sticker" id="sticker">

                            <div class="Sticker__text" id="stickerText">Pour Sonner</div>
                            <div class="Sticker__subtext" id="stickerSubtext">Scannez-moi !</div>
                            <img class="Sticker__qrcode" id="stickerQrcode" :src="myProperty.qrcode" />
                            <div class="Sticker__separation" id="stickerSeparation"></div>
                            <img class="Sticker__logo" id="stickerLogo" :src="stickerLogo" />
                            <p class="Sticker__signature" id="stickerSignature">Ce service est proposé par esonnette.com.</p>

                        </div>

                    </div>
                    <div class="ShellEditeur__right" id="ShellEditeur__right">

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

                        <button class="ShellEditeur__right-btnupdate" @click="updateSticker(true)">Modifier</button>
                        <button class="ShellEditeur__right-btnupdate" @click="updateSticker(false)">Réinitialisation</button>
                        <button class="ShellEditeur__right-btnupdate" @click="printSticker">Impression</button>

                    </div>
                </div>

            </div>

        </div>
    </div>

</template>

<script>

import { useAuthStore } from '../stores/auth.js';

import Loader from '../components/Loader.vue';
import Header from '../components/Header.vue';
import Sidebar from '../components/Sidebar.vue';
import Message from '../components/Message.vue';

export default {
    data() {
        return {
            stickerLogo: '/assets/images/logo_color.png',
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
            
            const authStore = useAuthStore();
            const token = authStore.token;

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
                            // data.result.length
                            // this.dataIsOkay = true
                            this.proprietes = data.result
                            this.myProperty = data.result[0]
                            this.getSticker()
                            // this.loadData = true
                        } else {
                            this.isVisibilityMessageOne = true 
                            this.isTypeMessageOne = "danger"
                            this.isMessageOne = "Vous devez définir au minimum une propriété."

                            // setTimeout(() => {
                            //     this.isVisibilityMessageOne = false;
                            // }, 3000);
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

            const authStore = useAuthStore();
            const token = authStore.token;
            
            fetch('/api/auth/getSticker', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
                body: JSON.stringify({
                    idPropriete: idPropriete.id
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
                            let configuration = data.result.configuration
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

        },
        updateSticker(reset) {

            let idPropriete = this.myProperty
            let border
            let background
            let title
            let subtitle
            let backgroundQrcode
            let colorQrcode
            let separation
            let signature

            if(reset) {
                border = this.border
                background = this.background
                title = this.title
                subtitle = this.subtitle
                backgroundQrcode = this.backgroundQrcode
                colorQrcode = this.colorQrcode
                separation = this.separation
                signature = this.signature
            } else {
                border = "#000000"
                background = "#FFFFFF"
                title = "#3056D3"
                subtitle = "#000000" 
                backgroundQrcode = "#FFFFFF"
                colorQrcode = "#FFFFFF"
                separation = "#000000"
                signature = "#000000"
            }

            const authStore = useAuthStore();
            const token = authStore.token;
            
            fetch('/api/auth/updateSticker', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
                body: JSON.stringify({
                    idPropriete: idPropriete.id,
                    border: border, 
                    background: background,
                    title: title,
                    subtitle: subtitle,
                    backgroundQrcode: backgroundQrcode,
                    colorQrcode: colorQrcode,
                    separation: separation,
                    signature: signature
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
                        this.isVisibilityMessageOne = true 
                        this.isTypeMessageOne = "success"
                        if(reset){
                            this.isMessageOne = "Le sticker a bien été mis à jour."
                        } else {
                            this.isMessageOne = "Le sticker a bien été réinitialiser."

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

                        }

                        setTimeout(() => {
                            this.isVisibilityMessageOne = false;
                        }, 3000);
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
        printSticker() {

            let ShellEditeurLeftHTML = document.getElementById("ShellEditeur__left")

            if(ShellEditeurLeftHTML){
                window.print();
            } else {
                this.isVisibilityMessageOne = true 
                this.isTypeMessageOne = "danger"
                this.isMessageOne = "Element à imprimer non trouvé."

                setTimeout(() => {
                    this.isVisibilityMessageOne = false;
                }, 3000);
            }

        }
    },
    components: { Loader, Header, Sidebar, Message }
}

</script>