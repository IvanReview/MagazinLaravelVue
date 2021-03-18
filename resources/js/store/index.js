import Vue from 'vue'
import Vuex from 'vuex'
import categories from "./categories";
import products from "./products"
import cart from "./cart";
import orders from "./orders";
import users from "./users";
import comment from "./comment";
import currency from "./currency";

import * as auth from '../helpers/http_service';
import axios from "axios";

let profile = auth.getProfile();
let isLogged = auth.isLoggedIn();


Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        apiURL: 'http://localhost:8000/api',
        serverPath: 'http://localhost:8000',
        profile: profile ? profile : {},
        isLoggedIn: isLogged ? isLogged : null,

    },
    actions: {
        logoutStore({commit}) {
            return axios({
                method: 'GET',
                url: '/api/auth/logout',
                headers: {
                    'Authorization': 'Bearer ' + auth.getAccessToken()
                }})
                .then((response) => {
                    localStorage.removeItem('laravel-vue-spa-token')
                    return response.data
                })
                .catch((error) => {
                    console.log(error)
                })
        },


        authenticateAction({commit}, user) {
            commit('authenticate', user)
        }
    },
    mutations: {
        authenticate(state, payload) {
            state.isLoggedIn = auth.isLoggedIn()
            if(state.isLoggedIn){
                state.profile = payload
            } else {
                state.profile = {}
            }
        }

    },
    getters: {
        getRole(state){
            return state.profile.role
        },
        getIsLogged(state) {
            return state.isLoggedIn
        },
        getProfile(state) {
          return state.profile
        }

    },
    modules: {
        categories,
        products,
        cart,
        orders,
        users,
        comment,
        currency
    }
})
