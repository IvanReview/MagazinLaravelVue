<template>
    <div class="main__wrapper">

        <person-navbar @clickOnMenu="isOpen = !isOpen"></person-navbar>

        <main>
            <div class="row">
                <!-- сайдбар -->
                <person-sidebar :value="isOpen"></person-sidebar>

                <!-- Контент  -->
                <div class="app-content" :class="{full: !isOpen}">
                    <router-view></router-view>
                </div>
            </div>
        </main>

        <PersonFooter/>
    </div>
</template>

<script>

import PersonFooter from "./PersonFooter";
import * as auth from "../../helpers/http_service";
import PersonNavbar from "./PersonNavbar";
import PersonSidebar from "./PersonSidebar";
export default {
name: "Person",
    components: {PersonSidebar, PersonNavbar, PersonFooter},
    data: function () {
        return {
            isOpen: true
        }
    },
    watch: {
    },
    methods: {
        open() {
            this.isOpen = false
        },
        logout() {

        }
    },
    beforeCreate() {
        //дефолтные заголовки для всех запросов
        axios.defaults.headers.common["Authorization"] = `Bearer ` + auth.getAccessToken()
    },
    mounted() {
        const user  = auth.getProfile()

        this.$store.dispatch('authenticateAction', user)

    }
}
</script>

<style scoped>

</style>
