<template>
    <div class="main__wrapper">

        <!-- Навбар -->
        <admin-navbar @clickOnMenu="isOpen = !isOpen"></admin-navbar>

        <main>
            <div class="row">
                    <!-- сайдбар -->
                <admin-sidebar :value="isOpen"></admin-sidebar>

                <!-- Контент  -->
                <div class="app-content" :class="{full: !isOpen}">
                    <router-view></router-view>
                </div>
            </div>
        </main>

        <!-- Футер -->
        <AdminFooter/>
    </div>
</template>

<script>
    import AdminNavbar from "./AdminNavbar";
    import AdminSidebar from "./AdminSidebar";
    import AdminFooter from "./AdminFooter";
    import * as auth from  '../../helpers/http_service'
    import {mapActions} from "vuex";

    export default {
        name: "AdminMain",
        components: {AdminFooter, AdminSidebar, AdminNavbar},
        data: function () {
            return {
                isOpen: true
            }
        },
        watch: {
            
        },
        methods: {
            ...mapActions([
                'loadAllComments',
                'loadComments'
            ]),

            open() {
                this.isOpen = false
            },

        },
        beforeCreate() {
            //дефолтные заголовки для всех запросов
            axios.defaults.headers.common["Authorization"] = `Bearer ` + auth.getAccessToken()
        },
        mounted() {
            this.loadComments()
            const user  = auth.getProfile()

            this.$store.dispatch('authenticateAction', user)

        }
    }
</script>

<style scoped>
    .main__wrapper{
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }





</style>
