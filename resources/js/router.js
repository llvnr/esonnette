import { createWebHistory, createRouter } from "vue-router";
import Dashboard from "./views/Dashboard.vue";
import Propriete from "./views/Propriete.vue";
import Profil from "./views/Profil.vue";
import VoirPropriete from "./views/Voirpropriete.vue";
import AddPropriete from "./views/Addpropriete.vue";
import Connexion from "./views/Connexion.vue";

const routes = [
    {
        path: '/',
        name: 'Dashboard',
        component: Dashboard
    },
    {
        path: '/propriete',
        name: 'Propriete',
        component: Propriete
    },
    {
        path: '/profil',
        name: 'Profil',
        component: Profil
    },
    {
        path: '/voir-propriete',
        name: 'VoirPropriete',
        component: VoirPropriete
    },
    {
        path: '/addpropriete',
        name: 'AddPropriete',
        component: AddPropriete
    },
    {
        path: '/connexion',
        name: 'Connexion',
        component: Connexion
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;