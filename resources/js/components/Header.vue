<template>

    <div class="ContentHeader">

        <div class="ContentHeader__colonneLeft">
            <div class="ContentHeader__colonneLeft-title">{{ title  }}</div>
        </div>
        <div class="ContentHeader__colonneRight">

            <ul class="ContentHeader__colonneRight-navigation">
                <router-link to="/profil" class="noDecor"><li class="ContentHeader__colonneRight-navigation-element">Mon profil</li></router-link>
                <li class="ContentHeader__colonneRight-navigation-element"><i class="bi bi-brightness-high-fill"></i></li>
            </ul>

        </div>

    </div>

</template>

<script setup>

const props = defineProps(['title'])
// console.log(props.title)

</script>