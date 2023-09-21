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

                EDITEUR

            </div>

        </div>
    </div>

</template>

<script>

import Loader from '../components/Loader.vue';
import Header from '../components/Header.vue';
import Sidebar from '../components/Sidebar.vue';

export default {
    data() {
        return {
            loadData: true
        }
    },
    components: { Loader, Header, Sidebar }
}

</script>