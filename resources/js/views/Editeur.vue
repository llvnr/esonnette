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

                <div class="ShellEditeur">
                    <div class="ShellEditeur__left">

                        <div class="Sticker">

                            <div class="Sticker__text">Pour Sonner</div>
                            <div class="Sticker__subtext">Scannez-moi !</div>
                            <img class="Sticker__qrcode" src="data:image/png;base64,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" />
                            <div class="Sticker__separation"></div>
                            <img class="Sticker__logo" src="assets/images/logo_color.png" />
                            <p class="Sticker__signature">Ce service est proposé par esonnette.com.</p>

                        </div>

                    </div>
                    <div class="ShellEditeur__right">

                        RIGHT

                    </div>
                </div>

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