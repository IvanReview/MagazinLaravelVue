import * as paginate from "../helpers/paginate";
import * as auth from "../helpers/http_service";
import axios from "axios";
let cart = window.localStorage.getItem('cart');


export default {
    state: {
        users: [],
        user: [],
        userError: [],


    },
    actions: {

        receiveUsers({commit}) {
           return  axios({
                method: 'GET',
                url: '/api/admin/users',
                headers: {
                    'Authorization': 'Bearer ' + auth.getAccessToken()
                }})
                .then((response) => {
                    commit('set_users', response.data.data)
                    return true

                })
                .catch((error) => {
                    console.log(error)
                })

        },


        updateUser({commit}, {formData, userIndex}) {
            return axios({
                method: 'POST',
                url: `/api/admin/users/${formData.get('id')}`,
                data: formData,
                headers: {
                    'Content-Type': 'multipart/form-data'
                }})
                .then((response) => {
                    if (response.status === 200) {
                        commit('update_users_to_state', {user:response.data, index:userIndex})
                        return response
                    }
                })
                .catch((error) => {
                    console.log(error)
                })
        },
        updateAdminProfile({commit}, formData) {
            return axios({
                method: 'POST',
                url: `/api/admin/users/${formData.get('id')}`,
                data: formData,
                headers: {
                    'Content-Type': 'multipart/form-data'
                }})
                .then((response) => {
                    if (response.status === 200) {
                        auth.changeProfile(response.data)

                        commit('update_users_to_state', response.data)
                        return response
                    }
                })
                .catch((error) => {
                    commit('profile_update_errors',error.response.data.errors)
                    console.log(error)
                })
        },


        updateUserProfile({commit}, formData) {
            return axios({
                method: 'POST',
                url: `/api/person/profile/${formData.get('id')}`,
                data: formData,
                headers: {
                    'Content-Type': 'multipart/form-data'
                }})
                .then((response) => {
                    if (response.status === 200) {
                        auth.changeProfile(response.data)

                        commit('update_users_to_state', response.data)
                        return response
                    }
                })
                .catch((error) => {
                    commit('profile_update_errors',error.response.data.errors)
                    console.log(error)
                })
        }



    },
    mutations: {

        set_users(state, users) {
            state.users = users
        },

        update_users_to_state(state, {user, index}) {
            state.users.splice(index, 1, user)
        },

        profile_update_errors(state, errors) {
            state.userError = errors
        }


    },

    getters: {
        getUsers(state) {
            return state.users
        },

        getUser(state) {
            return state.user
        },

        getUserErrors(state) {
            return state.userError
        }



    }
}
