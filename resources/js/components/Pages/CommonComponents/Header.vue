<template>
    <header>
        <div class="container">
            <div class="main-header">
                <div class="row">
                    <div class="col s12 m4 l4">
                        <div class="left-main-header">
                            <div class="phone-wrapp">
                                <i class="material-icons left">phone_in_talk</i>
                                <div class="phone">
                                    <span class="phone-text">Звоните 24/7</span>
                                    <span class="phone-number">070-7782-9137</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col l3 hide-on-med-and-down">
                        <div class="icon">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2f/Logo_TV_2015.svg/1164px-Logo_TV_2015.svg.png">
                        </div>
                    </div>

                    <div class="col s12 m8 l5">
                        <div class="right-main-header">
                            <div class="login" v-if="! getIsLogged">
                                <div class="login-control">
                                    <router-link class="btn waves-effect waves-light icon1" to="/login">
                                        <i class="material-icons left">input</i>
                                        <span class="login-control__text">Войти</span>
                                    </router-link>
                                </div>
                            </div>
                            <div class="account admin" v-if="getRole === 'admin'">
                                <div class="account-control">
                                    <router-link class=" btn waves-effect waves-light icon1"
                                          to="/admin"
                                          ref="account"
                                    >
                                        <i class="material-icons left">account_box</i>
                                        <span class="login-control__text">Админ</span>
                                    </router-link>

                                </div>
                            </div>
                            <div class="account user" v-if="getRole === 'user'">
                                <div class="account-control">
                                    <router-link class="btn waves-effect waves-light icon1"
                                                 to="/person"
                                                 ref="account"
                                    >
                                        <i class="material-icons left">supervisor_account</i>
                                        <span class="login-control__text">Моя панель</span>
                                    </router-link>

                                </div>
                            </div>
                            <div class="login logout" v-if="getIsLogged" @click="logout">
                                <div class="login-control">
                                    <button class="btn waves-effect waves-light icon1">
                                        <i class="material-icons left">input</i>
                                        <span class="login-control__text">Выйти</span>
                                    </button>
                                </div>
                            </div>
                            <div class="cart-header">
                                <div class="cart-control">
                                    <router-link to="/cart" class="icon-cart">
                                        <i class="material-icons left">shopping_cart</i>
                                        <span class="cart-text">Cart</span> ({{getProductsInCart.length}})
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="header-bottom" >
                <nav class="transparent">
                    <div class="nav-wrapper dark-text">
                        <div class="nav-wrapper right">

                            <div class="input-field" style="display: flex;">
                                <!-- <i class="material-icons">search</i> -->
                                <input id="search" type="search" placeholder="Поск товара..."
                                       v-model="search_pattern" @keyup.enter="searchProducts">
                                <label  class="label-icon" for="search">
                                    <i class="material-icons" @click.prevent="searchProducts">search</i>
                                </label>
                                <i class="material-icons" @click="clearSearch">close</i>
                            </div>

                        </div>
                        <div class="menu">
                            <ul id="nav-mobile" class="left hide-on-med-and-down menu-wrapp" >
                                <li><router-link class="menu__link" to="/" exact>Главная</router-link></li>
                                <li><router-link class="menu__link" to="/about">О нас</router-link></li>
                                <!--<li><router-link class="menu__link" to="/about">Мужики</router-link></li>-->
                                <li><router-link class="menu__link" to="/contact">Контакты</router-link></li>
                                <li><router-link class="menu__link" to="/tree">Древо</router-link></li>
                                <li class="currency-item">
                                    <!--Валюта-->
                                    <div class="input-field col s12 m3 ">
                                        <div class="currency">
                                            <select class="browser-default1"
                                                    v-model="currency"
                                                    @change="changeCurrency(currency)" ref="currency"
                                            >
                                                <option value="" disabled selected> Выберите валюту </option>
                                                <option v-for="item in currencyOption"
                                                        :value="item"
                                                > {{item}}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </li>

                            </ul>

                            <!-- Мобильное -->
                            <a href="#" @click.prevent="clickMenu" data-target="slide-out" class="sidenav-trigger">
                                <i class="material-icons" style="color: #1a202c">dehaze</i>
                            </a>

                            <ul id="slide-out" class="sidenav">
                                <li><div class="user-view">
                                    <div class="background">
                                        <img src="https://avatanplus.com/files/resources/original/5a7d51a521bd21617986ed12.jpg">
                                    </div>
                                    <a href="#user"><img class="circle" src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2f/Logo_TV_2015.svg/1164px-Logo_TV_2015.svg.png"></a>
                                </div></li>
                                <li><div class="divider"></div></li>
                                <li><a class="subheader"><i class="material-icons">view_comfy</i>Меню</a></li>
                                <li><a class="waves-effect" href="#!">Главная</a></li>
                                <li><a class="waves-effect" href="#!">О нас</a></li>
                                <li><a class="waves-effect" href="#!">Не о нас</a></li>
                                <li><a class="waves-effect" href="#!">Контакты</a></li>

                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>
</template>

<script>
import * as auth from '../../../helpers/http_service';
import {mapGetters, mapActions} from 'vuex'
export default {
    name: "Header",
    data: function () {
        return {
            tooltip: null,
            search_pattern: '',
            currencyOption: ['RUB', 'USD', 'EUR'],
            currency: 'RUB',

        }
    },
    computed: {
        ...mapGetters([
            'getProductsInCart',
            'getRole',
            'getIsLogged',
        ]),
        totalCostInCart() {
            let cost = 0
            this.getProductsInCart.forEach(item => {
                cost += item.price *item.quantity
            })
            return cost
        },
    },
    methods: {
        ...mapActions([
            'searchProductsInBd',
            'logoutStore',
            'changeCurrencyInState',
            'loadProducts'
        ]),
        searchProducts() {
            this.searchProductsInBd(this.search_pattern)

        },

        changeCurrency(){
            this.changeCurrencyInState(this.currency).then(resp => {
                this.currency_coefficient = resp.data.currency_coefficient
                
            })
            window.M.AutoInit();
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

        clearSearch() {
            this.search_pattern = ''
            this.loadProducts()
        }
    },
    mounted() {

    },

    destroyed() {


    }
}
</script>

<style>
    .container {
        max-width: 1280px !important;
        width: 100%;
        margin: 0 auto;
    }
    .logout .material-icons {
        transform: rotate(180deg);
    }
    .right-main-header {
        display: flex;
        justify-content: space-evenly;
    }

    .icon1 {
        transition: all .3s ease;
        border-radius: 30px;
        margin-top: 4px
    }
    .icon1  i {
        font-size: 25px
    }
    .currency-item {
        margin-left: 250px;
    }
    .dropdown-content li > a, .dropdown-content li > span {
        font-size: 14px;
    }

</style>
