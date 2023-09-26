import { createWebHistory, createRouter } from "vue-router";
import { useAuthStore } from "./stores/auth.js";

import Dashboard from "./views/Dashboard.vue";
import Propriete from "./views/Propriete.vue";
import Profil from "./views/Profil.vue";
import VoirPropriete from "./views/Voirpropriete.vue";
import AddPropriete from "./views/Addpropriete.vue";
import Connexion from "./views/Connexion.vue";
import Inscription from "./views/Inscription.vue";
import Code from "./views/Code.vue";
import Alerte from "./views/Alerte.vue";
import AddAlerte from "./views/AddAlerte.vue";
import Scan from "./views/Scan.vue";
import Editeur from "./views/Editeur.vue"

const routes = [
    {
        path: '/',
        name: 'Dashboard',
        component: Dashboard,
        meta: { requiresAuth: true } // Marquer la route comme nécessitant une authentification
    },
    {
        path: '/propriete',
        name: 'Propriete',
        component: Propriete,
        meta: { requiresAuth: true } // Marquer la route comme nécessitant une authentification
    },
    {
        path: '/profil',
        name: 'Profil',
        component: Profil,
        meta: { requiresAuth: true } // Marquer la route comme nécessitant une authentification
    },
    {
        path: '/voir-propriete/:id',
        name: 'VoirPropriete',
        component: VoirPropriete,
        meta: { requiresAuth: true } // Marquer la route comme nécessitant une authentification
    },
    {
        path: '/alerte/show/one/:id',
        name: 'Alerte',
        component: Alerte,
        meta: { requiresAuth: true } // Marquer la route comme nécessitant une authentification
    },
    {
        path: '/alerte/add/:type/:id',
        name: 'AddAlerte',
        component: AddAlerte,
        meta: { requiresAuth: true }
    },
    {
        path: '/addpropriete',
        name: 'AddPropriete',
        component: AddPropriete,
        meta: { requiresAuth: true } // Marquer la route comme nécessitant une authentification
    },
    {
        path: '/propriete/qrcode/:id',
        name: 'Scan',
        component: Scan,
    },
    {
        path: '/editeur',
        name: 'Editeur',
        component: Editeur,
        meta: { requiresAuth: true } // Marquer la route comme nécessitant une authentification
    },
    {
        path: '/connexion',
        name: 'Connexion',
        component: Connexion
    },
    {
        path: '/inscription',
        name: 'Inscription',
        component: Inscription
    },
    {
        path: '/code',
        name: 'Code',
        component: Code
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

// Ajouter un guard global pour vérifier l'authentification avant d'accéder à des routes protégées
router.beforeEach((to, from, next) => {

    const authStore = useAuthStore();

    if (to.meta.requiresAuth && !authStore.isAuthenticated) {
        // Si la route requiert une authentification et l'utilisateur n'est pas authentifié,
        // redirigez-le vers la page de connexion par exemple.
        next('/connexion');
        } else {
        // Sinon, autorisez la navigation.
        next();
    }

});

export default router;