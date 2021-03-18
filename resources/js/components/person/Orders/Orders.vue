<template>
    <div class="main-content">
        <div class="page-title">
            <h3 class="center-align category">Мои Заказы</h3>
        </div>

        <section>
            <div class="row" >

                <div class="row">
                    <div class="col s12 l12">
                        <div class="card">
                            <div class="card-content">
                                <div class="row">
                                    <div class="col s6">
                                        <p class="category-create__text">
                                            <i class="material-icons left">swap_vertical_circle</i> Мои заказы
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <loader v-if="loader"/>

                <p v-else-if="!orders.length" class="center-align" style="font-size: 40px">Заказы отсутствуют!</p>

                <div class="table" v-else>
                    <table class="striped centered responsive-table admin-table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Имя</th>
                            <th>Телефон</th>
                            <th>Время создания</th>
                            <th>Статус</th>
                            <th>Действие</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr v-for="order in orders">
                            <td>{{order.id}}</td>
                            <td>{{order.name}}</td>
                            <td>{{order.phone}}</td>
                            <td>{{order.created_at |  dateFilter}}</td>
                            <td>{{order.status ? 'Обработан' : 'Необработан'}}</td>
                            <td>
                                <a href="#modal1"
                                   class="btn waves-effect waves-light purple darken-4 modal-trigger"
                                   @click.prevent="openOrder(order)"
                                >
                                    <i class="material-icons">loupe</i>
                                </a>

                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!--Модальное окно просмотра заказа-->
        <modal-view-order
            :order="orderShow"
            :products-in-order="productsInOrder"
            :total_sum="totalSumInOrder"
        />


        <!--Пагинация-->
        <!--<div class="col s12 center-align pagination-admin">

            <ul class="pagination">
                <li :class="[{disabled: getPaginationAdminProduct.prev_page_url === null}]">
                    <a href=""
                       @click.prevent="loadProductsForAdmin(getPaginationAdminProduct.prev_page_url)"
                    ><i class="material-icons">chevron_left</i>
                    </a>
                </li>

                <li v-for="page of getPaginationAdminProduct.pages"
                    :class="[{active: getPaginationAdminProduct.current_page === page.label}]"
                >
                    <a href="" @click.prevent="loadProductsForAdmin( page.url)">{{page.label}}</a>
                </li>

                <li class="waves-effect"
                    :class="[{disabled: getPaginationAdminProduct.next_page_url === null}]"
                >
                    <a href=""
                       @click.prevent="loadProductsForAdmin(getPaginationAdminProduct.next_page_url)"
                    >
                        <i class="material-icons">chevron_right</i>
                    </a>
                </li>
            </ul>
        </div>-->
    </div>
</template>

<script>
import ModalViewOrder from "./ModalViewOrder";
import {mapActions, mapGetters} from "vuex";
import Loader from "../../Auxiliary/Loader";
export default {
    name: "Orders",
    data: ()=>({

        loader: true,

        orderShow: [],
        productsInOrder: [],

        orders: [],
        paginateOrdersUser: {
            url: "",
            lastPage: "",
            currentPage: ""
        },

    }),
    computed: {
        ...mapGetters([
            'getOrders',
        ]),

        totalSumInOrder() {
            let cost = 0

            this.productsInOrder.forEach(item => {
                cost += item.price * item.pivot.quantity
            })
            return cost
        }

    },
    methods: {
        ...mapActions([
            'totalSumInCart',
            'orderSend',
            'loadOrders'
        ]),
        openOrder(order) {
            this.orderShow = order
            this.productsInOrder = order.products
        },

        loadOrdersForPerson(offset = 0) {
            let url = this.paginateOrdersUser.url || "/api/person/orders"

            axios({
                method: 'GET',
                url: url,
                params: {},
            })
                .then((response) => {
                    this.orders = this.orders.concat(response.data.data)

                    this.paginateOrdersUser.url = response.data.next_page_url
                    this.paginateOrdersUser.lastPage = response.data.last_page
                    this.paginateOrdersUser.currentPage = response.data.current_page
                    this.loader = false

                })
                .catch((error) => {
                    console.log(error)
                })
        },

        scroll(event) {
            const scrollTop = Math.ceil(document.documentElement.scrollTop)
            const viewportHeight = window.innerHeight
            const total = document.documentElement.scrollHeight

            if( scrollTop + viewportHeight >= total-40
                && this.paginateOrdersUser.currentPage < this.paginateOrdersUser.lastPage)
            {
                this.loadOrdersForPerson()
            }

        }

    },
    created() {
        this.loadOrdersForPerson()

        let delayHandler =  _.debounce(this.scroll, 400)

        window.addEventListener('scroll', delayHandler )
    },
    mounted() {

        let elems = document.querySelectorAll('.modal')
        this.modalInstance = window.M.Modal.init(elems);

    },
    components: {Loader, ModalViewOrder}
}
</script>

<style scoped>

</style>
