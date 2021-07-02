<template>
    <div class="main-content">
        <div class="page-title">
            <h3 class="center-align category">Заказы</h3>
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
                                            <i class="material-icons ">swap_vertical_circle</i> Управление заказами
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <loader v-if="loader"/>

                <p v-else-if="!getOrders.length" class="order-admin"> Заказы отсутствуют</p>

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
                        <tr v-for="(order, index) in getOrders">
                            <td>{{order.id}}</td>
                            <td>{{order.name}}</td>
                            <td>{{order.phone}}</td>
                            <td>{{order.created_at |  dateFilter}}</td>
                            <td>{{order.status }}</td>
                            <td>
                                <a href="#modal1"
                                   class="btn waves-effect waves-light light-blue accent-3 modal-trigger"
                                   type="submit"
                                   @click="openOrder(order)"
                                >
                                    <i class="material-icons">loupe</i>
                                </a>

                                <button class="btn waves-effect waves-light pink darken-1"
                                        type="submit"
                                        @click="deleteOrder(order, index)"
                                >
                                    <i class="material-icons">delete</i>
                                </button>

                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!--Модальное окно просмотра заказа-->
        <modal-look-order
            :order="order_data"
            :products-in-order="products_in_order"
            :currency = currency_in_order
            :total_sum="totalSumInOrder"
            @executeOrder = changeOrderStatus
        />


        <!--Пагинация-->
        <div class="col s12 center-align pagination-order">

            <ul class="pagination">
                <li :class="[{disabled: getPaginateOrder.prev_page_url === null}]">
                    <a href=""
                       @click.prevent="loadOrders(getPaginateOrder.prev_page_url)"
                    ><i class="material-icons">chevron_left</i>
                    </a>
                </li>

                <!--Страницы-->
                <li v-for="page of getPaginateOrder.pages"
                    :class="[{active: getPaginateOrder.current_page == page.label}]"
                >
                    <a href="" @click.prevent="loadOrders( page.url)">{{page.label}}</a>
                </li>

                <li class="waves-effect"
                    :class="[{disabled: getPaginateOrder.next_page_url === null}]"
                >
                    <a href=""
                       @click.prevent="loadOrders(getPaginateOrder.next_page_url)"
                    >
                        <i class="material-icons">chevron_right</i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import ModalLookOrder from "./ModalLookOrder";
    import {mapActions, mapGetters} from "vuex";
    import Loader from "../../Auxiliary/Loader";
    export default {
        name: "Orders",
        components: {Loader, ModalLookOrder},
        data: ()=>({
            order_data: {},
            products_in_order: [],
            currency_in_order: {},
            loader: true,

        }),
        computed: {
            ...mapGetters([
                'getOrders',
                'getFullSum',
                'getOrderConfirmErrors',
                'getPaginateOrder'
            ]),

            totalSumInOrder() {
                let cost = 0
                this.products_in_order.forEach(item => {
                  cost += item.pivot.price * item.pivot.quantity
                })
                return cost
            }

        },
        methods: {
            ...mapActions([
                'totalSumInCart',
                'orderSend',
                'loadOrders',
                'changeOrder',
                'deleteOrderFromBd'
            ]),
            openOrder(order) {
                this.order_data = order
                this.products_in_order = order.products
                this.currency_in_order = order.currency

            },

            changeOrderStatus(order) {
                this.changeOrder(order).then( resp => {
                    this.$toasted.show(`Заказ выпонен!`,{
                        type: 'success',
                    })
                })
            },

            deleteOrder(order, index) {
                if(confirm('Точно???')) {
                    this.deleteOrderFromBd({order, index})
                }
            }

        },
        mounted() {
            this.loadOrders().then(resp => {
                if (resp){
                    this.loader = false
                }
            })

        },
    }
</script>

<style scoped>
    .main-content {
        padding: 0 40px;
    }

    .row .col{
        padding: 0;
    }

    .category-create__text{
        font-size: 25px;
    }
    .row{
        margin-bottom: 0;
    }

    .admin-table tr {
        border-bottom: 1px solid rgba(0,0,0,0.12) !important;
        background-color: #fff;
    }
    .admin-table{
        background-color: #fff;
    }
    .pagination-order {
        margin-top: 40px;
    }

    .pagination .active {
        background-color:  #e91e63  !important;
    }

    .main-content, section{
        position: relative;
        height: 100vh;
    }
    .pagination-order{
        position: absolute;
        bottom: 0;
    }

    .order-admin{
        font-size: 30px;
        font-weight: 800;
        text-align: center;
    }

</style>
