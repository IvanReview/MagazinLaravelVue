<template>
    <div class="col s12 m6 l4">
        <div class="card">
            <div class="card-image">

                <img :src="product.image ? `/storage/${product.image}` : `/storage/no_photo.jpg`" alt="Product">
                <a class="btn-floating halfway-fab waves-effect waves-light red modal-trigger"
                   :href="'#modal3' + product.id"
                >
                    <i class="material-icons">loupe</i>
                </a>
            </div>
            <div class="card-content">
                <span class="card-title">
                    <router-link :to="{name: 'OneProduct', params: { id: product.id}}">
                        {{product.name}}
                    </router-link>
                </span>
                <div class="card-price">
                    <span class="card-price__new">
                        Цена: {{product.price * getCurrency.currency_coefficient  | currencyFilter(getCurrency.currency_code) }}
                    </span>
                    <span class="card-price__old">
                        {{ Math.floor(product.price * getCurrency.currency_coefficient * 1.2) | currencyFilter(getCurrency.currency_code)}}
                    </span>
                </div>
                <div class="rating">
                    <i class="material-icons left">star</i>
                    <i class="material-icons left">star</i>
                    <i class="material-icons left">star</i>
                    <i class="material-icons left">star</i>
                    <i class="material-icons left">star_half</i>
                </div>
                <div class="card-buttons">
                    <button class="waves-effect waves-light btn red" disabled v-if="!product.count">
                        <i class="material-icons left">shopping_cart</i> no
                    </button>
                    <button class="waves-effect waves-light btn" @click="addToCart" v-else>
                        <i class="material-icons left">shopping_cart</i> add
                    </button>
                    <router-link class="waves-effect waves-light btn red look"
                                 :to="{name: 'OneProduct', params: { id: product.id}}">
                        <i class="material-icons right">aspect_ratio</i>look
                    </router-link>
                </div>
            </div>
        </div>

        <modal-product
            :product_data="product"
        />


    </div>

</template>

<script>
import {mapActions, mapGetters} from 'vuex'
import ModalProduct from "./ModalProduct";

export default {
    name: "ProductItem",
    components: {ModalProduct},
    props: {
        product: {},
        index: 0,
    },
    computed: {
        ...mapGetters([
            'getCurrency',
        ]),
    },
    methods: {
        addToCart(){
            this.$emit('addToCartData', this.product, this.index, this.getCurrency)
        },

    },
    mounted() {
        window.M.AutoInit();

    }
}
</script>

<style scoped>
    .card-image{
        text-align: center;
        display: flex;
        margin: 0 auto;
    }
    .card-image img{
        width: 200px;
        height: 220px;
    }

</style>
