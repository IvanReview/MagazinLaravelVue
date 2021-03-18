<template>
    <div class="sidebar-admin">
        <ul id="slide-out" class="sidenav app-sidenav" :class="{open: value }">
            <li><div class="user-view">
                <div class="background">
                    <img src="https://avatanplus.com/files/resources/original/5732d250e3a1a1549e858c24.jpg">
                </div>
                <a href="#user">
                    <img class="circle" :src="getProfile.image ? `/storage/${getProfile.image}` : `/storage/no_photo.jpg`">
                </a>
                <a href="#name"><span class="white-text name">Пользователь: {{getProfile.name}}</span></a>
                <a href="#email"><span class="white-text email">{{getProfile.email}}</span></a>
            </div></li>


            <li>
                <router-link to="/" class="waves-effect" exact>
                    <i class="material-icons">arrow_back</i> На главную
                </router-link>
            </li>
            <li><div class="divider"></div></li>

            <li>
                <router-link to="/person" class="waves-effect" exact>
                    <i class="material-icons">add_shopping_cart</i> Заказы
                </router-link>
            </li>
            <li><div class="divider"></div></li>
        </ul>
    </div>
</template>

<script>
import * as auth from '../../helpers/http_service'
import {mapGetters} from "vuex";

export default {
    name: "PersonSidebar",
    props: {
        value: null
    },
    data: () => ({
        user: {},

        errors: {},
    }),
    computed: {
        ...mapGetters([
            'getProfile'
        ]),

        profile() {
            return auth.getProfile()
        }

    },
    mounted() {

    },

}
</script>

<style scoped>
.sidenav {
    top: 64px;
    position:  absolute;
}
.app-sidenav.open {
    transform: translateX(0);
}

</style>
