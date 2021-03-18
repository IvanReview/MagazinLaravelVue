<template>
    <div class="nav__wrapper">
        <nav class="navbar  grey darken-4 ">
            <div class="nav-wrapper">
                <!--<a href="#" data-target="slide-out" class="sidenav-trigger show-on-large ">
                    <i class="material-icons text-white">dehaze</i>
                </a>-->
                <a href="#" class="sidenav-trigger show-on-large" @click.prevent="clickMenu" data-target="slide-out1">
                    <i class="material-icons text-white">dehaze</i>
                </a>

                <a href="#" class="brand-logo1">{{date | dateFilter}}</a>


                <ul class="right hide-on-small-and-down">
                    <!-- Dropdown Trigger -->
                    <li>
                        <a class="dropdown-trigger" href=" " data-target="dropdown" ref="dropdown">
                        Пользователь: {{$store.state.profile.name }} <i class="material-icons right">arrow_drop_down</i>
                    </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!--всплывающее меню-->
        <ul id="dropdown" class="dropdown-content" >
            <li>
                <router-link to="/admin/profile" class="black-text">
                    <i class="material-icons">account_circle</i>Профиль
                </router-link>
            </li>
            <li class="divider"></li>
            <li>
                <a href="#" class="black-text" @click.prevent="logout">
                    <i class="material-icons">exit_to_app</i>Выйти
                </a>
            </li>
        </ul>
    </div>

</template>

<script>
    import {mapActions} from "vuex"
    export default {
        name: "AdminNavbar",
        data: function () {
            return {
                date: new Date(),
                interval: null,
                dropdown: null,

            }
        },
        methods: {
            ...mapActions([
                "logoutStore"

            ]),

            clickMenu() {
                this.$emit('clickOnMenu')
            },

            logout() {
                this.logoutStore().then(response => {
                    if (this.$route.name !== 'MainPage') {
                        this.$router.push('/')
                    }
                    this.$store.dispatch('authenticateAction')

                    this.$toasted.show(response.message,{});
                })

            },
        },
        mounted() {
            this.interval = setInterval( () => {
                this.date = new Date()
            }, 1000);

            //navbar
            this.dropdown = M.Dropdown.init(this.$refs.dropdown, {
                constrainWidth: true
            });
        },
        destroyed() {
            clearInterval(this.interval)
        }
    }
</script>

<style scoped>
    #dropdown{
        top: -65px
    }
    .nav__wrapper{
        position: static;
    }
    .navbar{
        position: static;
        padding: 0 40px 0 40px;
    }

</style>
