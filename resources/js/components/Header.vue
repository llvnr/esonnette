<template>

    <div class="ContentHeader">

        <div class="ContentHeader__colonneLeft">
            <div class="ContentHeader__colonneLeft-title">{{ title  }}</div>
        </div>
        <div class="ContentHeader__colonneRight">

            <ul v-if="isLogging" class="ContentHeader__colonneRight-navigation">
                <router-link to="/profil" class="noDecor"><li class="ContentHeader__colonneRight-navigation-element">Mon profil</li></router-link>
                <li class="ContentHeader__colonneRight-navigation-element"><i class="bi bi-brightness-high-fill"></i></li>
            </ul>
            <ul v-else class="ContentHeader__colonneRight-navigation">
                <li class="ContentHeader__colonneRight-navigation-element"><i class="bi bi-brightness-high-fill"></i></li>
            </ul>

        </div>

    </div>

</template>

<script setup>
import { ref } from 'vue';

const props = defineProps(['title'])

// Déclaration des variables data réactives
const isLogging = ref(false)

</script>