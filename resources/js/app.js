import './bootstrap';
import { createApp } from 'vue';
import { createPinia } from 'pinia'; // Importez createPinia depuis Pinia
import router from './router.js';
import App from './App.vue';

const app = createApp(App);

// Créez une instance de Pinia et utilisez-la dans votre application
const pinia = createPinia();
app.use(pinia);

app.use(router).mount('#app');