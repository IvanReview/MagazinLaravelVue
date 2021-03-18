<template>
    <div class="sidebar-admin">
        <ul id="slide-out" class="sidenav app-sidenav" :class="{open: value }">
            <li><div class="user-view">
                <div class="background">
                    <img src="https://avatanplus.com/files/resources/original/5732d250e3a1a1549e858c24.jpg">
                </div>
                <a href="#user"><img class="circle" :src="`/storage/${getProfile.image}`"></a>
                <a href="#name"><span class="white-text name">SUPERUSER: {{getProfile.name}}</span></a>
                <a href="#email"><span class="white-text email">{{getProfile.email}}</span></a>
            </div></li>


            <li>
                <router-link to="/" class="waves-effect" exact>
                    <i class="material-icons">arrow_back</i> На главную
                </router-link>
            </li>
            <li><div class="divider"></div></li>

            <li>
                <router-link to="/admin" class="waves-effect" exact>
                    <i class="material-icons">add_shopping_cart</i> Заказы
                </router-link>
            </li>
            <li><div class="divider"></div></li>
            <li>
                <router-link to="/admin/categories" class="waves-effect">
                    <i class="material-icons">local_offer</i> Категории
                </router-link>
            </li>
            <li><div class="divider"></div></li>
            <li>
                <router-link to="/admin/products" class="waves-effect">
                    <i class="material-icons">restaurant_menu</i> Продукты
                </router-link>
            </li>
            <li><div class="divider"></div></li>
            <li>
                <router-link to="/admin/users" class="waves-effect">
                    <i class="material-icons">accessibility</i> Пользователи
                </router-link>
            </li>
            <li><div class="divider"></div></li>
            <li>
                <router-link to="/admin/comments" class="waves-effect">
                    <i class="material-icons">comment</i> Комментарии
                    <span class="new badge">{{ comment_count }}</span>
                </router-link>
            </li>
        </ul>
    </div>
</template>

<script>
    import * as auth from '../../helpers/http_service'
    import {mapGetters} from "vuex";

    export default {
        name: "AdminSidebar",
        props: {
            value: null
        },
        data: () => ({
            user: {},

            errors: {},
        }),
        computed: {
            ...mapGetters([
                "getProfile",
                "getCommentsAll",
                'getComments'
            ]),

            //уведомление о новых комментариях
            comment_count() {
                let comment_status = this.getComments.filter((comment) => {
                    return comment.status == 0
                })
                return comment_status.length
            },

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
