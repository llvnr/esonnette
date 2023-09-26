import { defineStore } from 'pinia';

export const useAuthStore = defineStore('auth', {
    state: () => ({
        // Définissez ici les données d'authentification
        user: null, // On stocke ici l'utilisateur actuellement connecté.
        token: null, // On stocke le token d'authentification
        isAuthenticated: false, // Indicateur du statut de connexion
        email: null // On stocke ici l'email reçu
    }),

    actions: {
        async chugc(email) {
            try {
                
                const response = await fetch('/api/auth/chugc', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        email: email
                    })
                });

                if(response.status === 200){
                    this.email = email 
                    return true; // Authentification réussie.
                } else {
                    return false;
                }

            } catch (error) {
                console.log("Erreur d'authentification : ", error);
                return false; // Authentification échouée.
            }
        },

        async login(credentials) {
            try {
                
                console.log(this.email)

                const response = await fetch('/api/auth/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        email: this.email,
                        code: credentials
                    })
                })

                if(response.status === 200){

                    const data = await response.json();

                    this.token = data.result.original.access_token
                    this.user = data.result.original.user
                    this.isAuthenticated = true

                    return true;

                } else {
                    console.log('TU ENTRE PAS ICI PCKE 200')
                    return false;
                }
                
            } catch (error) {
                return false;
            }
        },

        logout() {

        },
    },
    
    getters: {
        getIsAuthenticated() {
            return this.isAuthenticated
        },

        getUser() {
            return this.user;
        },
    },

});