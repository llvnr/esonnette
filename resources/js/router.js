import { createWebHistory, createRouter } from "vue-router";
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
    if (to.matched.some(record => record.meta.requiresAuth)) {
      const token = localStorage.getItem('token');
      if (!token) {
        // L'utilisateur n'est pas authentifié, rediriger vers la page de connexion
        next('/connexion');
      } else {
        // L'utilisateur est authentifié, autoriser l'accès à la route

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
                next('/connexion')
            } else {
                next();
            }

        })
        .catch(error => console.log(error));
      }
    } else {
      // La route ne nécessite pas d'authentification, autoriser l'accès
      next();
    }
});

export default router;