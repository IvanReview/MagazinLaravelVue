<template>
    <section class="check-out">
        <div class="container">
            <div class="row">

                <div class="shop-step">
                    <div class="col s12 m4 l4">
                        <div class="step ">
                            <div class="count">01</div>
                            <span class="label">Козина</span>
                        </div>
                    </div>

                    <div class="col s12 m4 l4">
                        <div class="step checked ">
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
                <div class="col s12  l6">
                    <div class="check-out__wrapper white center-align">
                        <h4 class="check-out__title">Данные клиента</h4>

                        <div class="row">
                            <div class="input-field col s12">
                                <div class="selectbox">
                                    <select name="country" id="country-order">
                                        <option value="RUS" disabled="" selected="">Выберите страну</option>
                                        <option value="RUS">Россия</option>
                                        <option value="US">US</option>
                                        <option value="UK">UK</option>
                                    </select>
                                    <label for="country-order">Страна</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s6">
                                <label for="first-name">Имя *</label>
                                <input name="first-name" type="text" placeholder="Введите Имя.."
                                       class="input-text"
                                       v-model="name"
                                >
                                <span class="helper-text invalid"
                                      v-if="getOrderConfirmErrors.name"
                                >
                                    {{getOrderConfirmErrors.name[0]}}
                                </span>
                            </div>
                            <div class="input-field col s6">

                                <label for="last-name">Фамилия *</label>

                                <input type="text" name="last-name"
                                       placeholder="Введите Фамилию.."
                                       class="input-text"
                                       v-model="surname"
                                >
                                <span class="helper-text invalid"
                                      v-if="getOrderConfirmErrors.surname"
                                >
                                    {{getOrderConfirmErrors.surname[0]}}
                                </span>

                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <label for="address">Адрес *</label>
                                <input type="text" name="address"
                                       placeholder="Введите название улицы..."
                                       class="input-text"
                                       v-model="address"
                                >
                                <span class="helper-text invalid"
                                      v-if="getOrderConfirmErrors.address"
                                >
                                    {{getOrderConfirmErrors.address[0]}}
                                </span>
                                <input type="text" name="apartment"
                                       placeholder="Введите № дома/квартиры..."
                                       class="input-text"
                                       v-model="flatNumber"
                                >
                                <span class="helper-text invalid"
                                      v-if="getOrderConfirmErrors.flatNumber"
                                >
                                    {{getOrderConfirmErrors.flatNumber[0]}}
                                </span>
                            </div>

                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <label for="town">Город *</label>
                                <input type="text" name="town"
                                       class="input-text"
                                       placeholder="Введите название города..."
                                       v-model="town"
                                >
                                <span class="helper-text invalid"
                                      v-if="getOrderConfirmErrors.town"
                                >
                                    {{getOrderConfirmErrors.town[0]}}
                                </span>
                            </div>

                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <label for="postcode">Почтовый индекс *</label>
                                <input type="text" name="postcode"
                                       class="input-text"
                                       placeholder="Введите почтовый индекс..."
                                       v-model="postIndex"
                                >
                                <span class="helper-text invalid"
                                      v-if="getOrderConfirmErrors.postIndex"
                                >
                                    {{getOrderConfirmErrors.postIndex[0]}}
                                </span>
                            </div>

                        </div>

                        <div class="row">
                            <div class="input-field col s6">
                                <label for="emailOrder">Email адрес*</label>
                                <input id="emailOrder"
                                       type="text"
                                       class="input-text"
                                       v-model="email"
                                >
                                <span class="helper-text invalid"
                                      v-if="getOrderConfirmErrors.email"
                                >
                                    {{getOrderConfirmErrors.email[0]}}
                                </span>
                            </div>

                            <div class="input-field col s6">
                                <label for="phone">Номер телефона *</label>
                                <input type="text" name="phone"
                                       class="input-text"
                                       id="phone"
                                       v-model="phone"
                                >
                                <span class="helper-text invalid"
                                      v-if="getOrderConfirmErrors.phone"
                                >
                                    {{getOrderConfirmErrors.phone[0]}}
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col 12">
                                <p>
                                    <label>
                                        <input type="checkbox" v-model="confirmPersonalData" />
                                        <span>Согласны на обработку данных?</span>
                                    </label>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col s12  l6">
                    <div class="check-out__wrapper white center-align">
                        <h4 class="check-out__title">Доставить на другой адрес?</h4>
                        <div class="row">
                            <div class="input-field col s12">
                                <div class="selectbox">
                                    <select name="country" id="country">
                                        <option value="RUS" disabled="" selected="">Выберите страну</option>
                                        <option value="RUS">Россия</option>
                                        <option value="US">US</option>
                                        <option value="UK">UK</option>
                                    </select>
                                    <label for="country">Страна</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <label for="first-name">Имя *</label>
                                <input name="first-name" type="text" placeholder="Введите Имя.." class="input-text" id="first-name" required="">
                            </div>
                            <div class="input-field col s6">

                                <label for="last-name">Фамилия *</label>

                                <input type="text" name="last-name" placeholder="Введите Фамилию.." class="input-text" id="last-name" required="">

                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <label for="address">Адрес *</label>
                                <input type="text" name="address" placeholder="Введите название улицы..." class="input-text" id="address" required="">
                                <input type="text" name="apartment" placeholder="Введите № дома/квартиры..." class="input-text" id="apartment">
                            </div>

                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <label for="town">Город *</label>
                                <input type="text" name="town" class="input-text" id="town" placeholder="Введите название города...">
                            </div>

                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <label for="postcode">Почтовый индекс *</label>
                                <input type="text" name="postcode" class="input-text " id="postcode" required="" placeholder="Введите почтовый индекс..." >
                            </div>

                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="textarea1" class="materialize-textarea browser-default"></textarea>
                                <label for="textarea1">Примечание</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col 12">
                                <p>
                                    <label>
                                        <input type="checkbox" />
                                        <span>Подтведите доставку на другой адрес</span>
                                    </label>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="your-order">
                    <h4 class="title">Ваш заказ</h4>

                    <div class="row">
                        <div class="col s12 l6">
                            <div class="product-total">
                                <table>
                                    <tbody>
                                    <tr class="table-title">
                                        <th>Продукты</th>
                                        <th class="right-align">Стоимость</th>
                                    </tr>
                                    <tr class="product-order">
                                        <td colspan="2">
                                            <ul>
                                                <li v-for="product in getProductsInCart">
                                                    <span class="product-qty">
                                                        <a href="">{{product.name}}</a>  <span class="count"> x {{product.quantity}}</span>
                                                    </span>
                                                    <span class="price">${{product.price}}</span>
                                                </li>

                                            </ul>
                                        </td>
                                    </tr>
                                    <tr class="cart-subtotal">
                                        <th>Общая стоимость:</th>
                                        <td><strong><span class="amount">${{totalCostInCart}}</span></strong></td>
                                    </tr>
                                    <tr class="shipping">
                                        <th>Доставка:</th>
                                        <td>Бесплатная</td>
                                    </tr>
                                    <tr class="order-total grey darken-4 white-text">
                                        <th><div class="black-bg">Общая сумма заказа:</div></th>
                                        <td><div class="black-bg"><span class="amount">${{totalCostInCart}}</span></div></td>
                                    </tr>
                                    </tbody></table>
                            </div><!-- .product-total -->
                        </div>

                        <div class="col s12 l6">
                            <div class="payment_methods">
                                <ul>
                                    <li>
                                        <div class="checkbox">
                                            <p>
                                                <label>
                                                    <input type="radio" name="group1" />
                                                    <span>Банковский перевод</span>
                                                </label>
                                            </p>
                                        </div>
                                        <div class="payment-box">
                                            <p>Make your payment directly into our bank account. Please use your Order ID as the 		payment reference. Your order won’t be shipped until the funds have cleared in our 		account.
                                            </p>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="checkbox">
                                            <p>
                                                <label>
                                                    <input type="radio" name="group1" />
                                                    <span>Заплатить при получении</span>
                                                </label>
                                            </p>
                                        </div>
                                    </li>

                                    <li class="paypal-method">
                                        <div class="checkbox">
                                            <p>
                                                <label>
                                                    <input type="radio" name="group1" />
                                                    <span>Paypal</span>
                                                </label>
                                            </p>
                                            <img src="img/payment-checkout.png" alt="pay ment">
                                            <a href="#">What is paypal?</a>
                                        </div>
                                        <p>Pay via PayPal you can pay with your credit card if you don’t have a PayPal account</p>
                                    </li>

                                </ul>

                            </div><!-- .payment_methods -->

                        </div>

                        <div class="col s12">
                            <div class="button-confirm">
                                <a class="btn-large"  @click.prevent="saveOrder" ref="btnSubmit">
                                    <i class="material-icons right">send</i>оформить заказ
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</template>

<script>
import {mapGetters,mapActions} from "vuex"
import * as auth from "../../../helpers/http_service";
import * as buttons from "../../../helpers/load_buttons";
export default {
    name: "OrderConfirm",
    data: () =>({
        name: '',
        surname: "",
        phone: '',
        email: '',
        address: '',
        flatNumber:'',
        postIndex: '',
        town: "",
        user_id: '',
        confirmPersonalData: false,
        btnOldHtml: '',


    }),
    computed: {
        ...mapGetters([
            'getProductsInCart',
            'getFullSum',
            'getOrderConfirmErrors'
        ]),
        totalCostInCart() {
            let cost = 0
            this.getProductsInCart.forEach(item => {
                cost += item.price * item.quantity
            })
            return cost
        }
    },
    methods: {
        ...mapActions([
            'totalSumInCart',
            'orderSend',
        ]),

        saveOrder(){
            const orderData = {
                name: this.name,
                surname: this.surname,
                phone: this.phone,
                email: this.email,
                address: this.address,
                postIndex: this.postIndex,
                productsInCart: this.getProductsInCart,
                user_id: this.user_id
            };


            if (this.confirmPersonalData){
                //отключение кнопки
                buttons.disableSubmission(this.$refs.btnSubmit)
                this.orderSend(orderData).then(response => {
                    if (response.status === 200){
                        window.localStorage.removeItem('cart');
                        buttons.enableSubmission(this.$refs.btnSubmit)

                        this.$toasted.show('Заказ принят в обработку!',{
                            type: 'success',
                        });
                        this.$router.push('/order-complete')
                    } else if (response === 422) {
                        buttons.enableSubmission(this.$refs.btnSubmit)
                        this.$toasted.show("Заполните правильно данные формы",{
                            type: 'error',
                        });
                    }
                })

            } else {
                this.$toasted.show('Согласитесь на обработку персональных данных',{
                    type: 'error',
                });
            }

        },

        /*disableSubmission(btn){
            btn.setAttribute('disabled','disabled')
            this.btnOldHtml = btn.innerHTML
            btn.innerHTML = '<span class = "fa fa-spinner fa-spin"></span> Пожалуйста подождите...'
        },

        enableSubmission(btn){
            btn.removeAttribute('disabled')
            btn.innerHTML = this.btnOldHtml
        }*/
    },
    mounted() {
        let user = auth.getProfile()
        if (user){
            this.name = user.name
            this.email = user.email
            this.user_id = user.id
            this.phone = user.phone
            this.surname = user.surname
        }


        M.AutoInit();
        setTimeout(()=>{
            window.M.updateTextFields()
        },0)
    }

}
</script>

<style scoped>

</style>
