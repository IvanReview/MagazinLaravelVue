<template>
    <section class="cart">
        <div class="container">
            <div class="row">
                <div class="shop-step">
                    <div class="col s12 m4 l4">
                        <div class="step checked">
                            <div class="count">01</div>
                            <span class="label">Козина</span>
                        </div>
                    </div>

                    <div class="col s12 m4 l4">
                        <div class="step ">
                            <span class="count">02</span>
                            <span class="label">Подтверждение заказа</span>
                        </div>

                    </div>

                    <div class="col s12 m4 l4">
                        <div class="step ">
                            <span class="count">03</span>
                            <span class="label">Заказ Сделан</span>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="cart-form">
                    <table class="cart-table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Продукт</th>
                            <th>Цена</th>
                            <th style="text-align: center;">Количество</th>
                            <th> сумма</th>
                        </tr>
                        </thead>

                        <tbody>

                        <tr v-if="!getProductsInCart.length">
                            <td></td>
                            <td colspan="5">
                                <p class="center-align no-product">Товары в корзине отсутствуют!</p>
                            </td>
                        </tr>

                        <tr v-for="(product,index) in getProductsInCart" :key="product.id" v-else>
                            <td class="product-remove" @click="deleteProductFromCart(index)">
                                <i class="material-icons">delete_forever</i>
                            </td>
                            <td class="product-name">
                                <img :src="`/storage/${product.image}`" alt="">
                                <a href="#">
                                    <span>{{product.name}}</span>
                                </a>
                            </td>
                            <td class="product-price">
                                <p class="price">{{product.price  | currencyFilter(getCurrency.currency_code)}}</p>
                            </td>
                            <td>
                                <div class="quantity">
                                    <div class="minus qt" @click="decrementItem(index)">
                                        <i class="fa fa-minus"></i>
                                    </div>
                                    <span class="number">{{product.quantity}}</span>
                                    <div class="qt plus" @click="incrementItem(index,product)">
                                        <i class="fa fa-plus"></i>
                                    </div>
                                </div>
                            </td>
                            <td class="product-subtotal">
                                <p class="price">
                                    {{product.quantity * product.price  | currencyFilter(getCurrency.currency_code)}}
                                </p>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>

            </div>

            <div class="row">
                <div class="totals">
                    <div class="col s12 l6">
                        <div class="shipping-wrapp">

                            <h3 class="title"><span>Посчитать доставку</span></h3>
                            <form action="#">

                                <div class="selectbox cart-input">
                                    <select name="country">
                                        <option value="vietnam">RUS</option>
                                        <option value="us">US</option>
                                        <option value="uk">UK</option>
                                    </select>
                                </div>

                                <div class="selectbox cart-input">
                                    <select name="country">
                                        <option value="vietnam" disabled="" selected="">Город</option>
                                        <option value="vietnam">Москва</option>
                                        <option value="vietnam">Лондон</option>
                                        <option value="vietnam">Детройт</option>
                                    </select>
                                </div>

                                <div class="input-text cart-input">
                                    <input type="text" placeholder="Почтовый Индекс">
                                </div>
                                <div class="input-submit">
                                    <a href="" class="submit btn"><i class="material-icons right">autorenew</i>
                                        Обновить общую стоимость
                                    </a>
                                </div>
                            </form>
                        </div>

                    </div>

                    <div class="col s12 l6">
                        <div class="shipping-wrapp">
                            <h3 class="title"><span>Общая сумма</span></h3>

                            <div class="cart-subtotal 	line">
                                <div class="line-title">Стоимость товара:</div>
                                <div><strong>
                                    <span class="amount">
                                        {{fullSumInCart() | currencyFilter(getCurrency.currency_code)}}
                                    </span>
                                </strong></div>
                            </div>

                            <div class="shipping line">
                                <div class="line-title">Доставка:</div>
                                <div>Бесплатная доставка</div>
                            </div>

                            <div class="order-total grey darken-3 line">
                                <div class="line-title">Общая сумма заказа:</div>
                                <div class="black-bg">
                                    <strong><span class="amount">
                                        {{ Math.floor(fullSumInCart()*1.0) | currencyFilter(getCurrency.currency_code)}}
                                    </span></strong>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="col s12">
                        <div class="shipping-wrapp">
                            <div class="cc clearfix">
                                <div class="input-submit backshop">
                                    <router-link to="/" class="submit btn-large transparent" exact>
                                        <i class="material-icons left">assignment_return</i> Назад в магазин
                                    </router-link>
                                </div>
                                <div class="input-submit processcheck" v-if="getProductsInCart.length">
                                    <router-link to="/order" class="submit btn-large">
                                        Перейти к оформлению <i class="material-icons right">forward</i>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

</template>

<script>
import {mapActions, mapGetters} from 'vuex'
export default {
    name: "Cart",
    data: () =>({
        productsInCart: [],
        sum: 0
    }),
    computed: {
        ...mapGetters([
            'getProductsInCart',
            'getCurrency'
        ]),

    },
    methods: {
        ...mapActions([
            'incrementCart',
            'decrementCart',
            'deleteProductCart',
            'totalSumInCart'
        ]),

        fullSumInCart() {
            this.totalSumInCart().then(resp => this.sum = resp)
            return this.sum
        },

        decrementItem(index) {
            this.decrementCart(index)
        },

        incrementItem(index, product) {
            //если число запрашиваемого товара <= кол на складе идем дальше иначе товар кончился
            if (product.quantity + 1 <= product.count) {
                this.incrementCart(index)
            } else {
                this.$toasted.show(`Увы товар ${product.name} закончился на складе!`,{
                    type: 'error',
                })
            }
        },

        deleteProductFromCart(index) {
            this.deleteProductCart(index)
            this.$toasted.show('Товар Удален из корзины!',{
                type: 'error',
            })
        },
    },
    mounted() {
        window.M.AutoInit();
    }
}
</script>

<style scoped>
    .backshop:hover{
        color: #fff;
    }
    .no-product{
        font-size: 40px;
    }

</style>
