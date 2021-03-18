import * as paginate from "../helpers/paginate";
let cart = window.localStorage.getItem('cart');


export default {
    state: {
        orders: [],
        paginateOrders: {},
        paginateOrdersUser: {
            url: "",
            lastPage: "",
            currentPage: ""
        },
        ordersUrl: '',
        ordersUser: []

    },
    actions: {
        loadOrders({commit, state}, page_url) {

            let url = page_url|| "/api/admin/orders"
            return  axios({
                method: 'GET',
                url: url,
                params: {},
            })
                .then((response) => {

                    //задать различ парам пагинации
                    const pagination = paginate.makePaginationForAdminOrders(response.data)

                    commit('set_paginate_for_order', pagination)
                    commit('set_orders', response.data.data)
                    return true

                })
                .catch((error) => {
                    console.log(error)
                })
        },

        changeOrder({commit},order) {
            return axios({
                method: 'POST',
                url: `/api/admin/orders/${order.id}`,
                data: {
                    status: 1,
                    _method: 'PUT'
                },
                headers: {
                }})
                .then((response) => {
                    console.log(response.data)
                    if (response.status === 200){
                        commit('execute_order', response.data)

                        return response
                    }
                })
                .catch((error) => {
                    console.log(error)
                })
        },

        deleteOrderFromBd({commit}, {order, index}) {
            axios({
                method: 'DELETE',
                url: `/api/admin/orders/${order.id}`,
            })
                .then((response) => {
                    commit('delete_order', index)

                })
                .catch((error) => {
                    console.log(error)
                })

        }


    },
    mutations: {


        set_orders(state, orders) {
            state.orders = orders
        },


        set_paginate_for_order(state, paginate) {
            state.paginateOrders = paginate
        },


        clear_orders(state) {
            state.orders = []
        },

        add_order(state, order) {
            state.orders.unshift(order)
        },

        execute_order(state, order) {
            let index = state.orders.findIndex(item => item.id == order.id)
            state.orders.splice(index, 1, order)
        },

        delete_order(state, index) {
            state.orders.splice(index, 1)
        },

    },

    getters: {
        getOrders(state) {
            return state.orders
        },

        getPaginateOrder(state) {
            return state.paginateOrders
        },


    }
}
