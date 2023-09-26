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

                console.log('RESPONSE', response)

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

        login(credentials) {

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