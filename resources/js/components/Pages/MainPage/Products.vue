<template>
    <div class="products">
        <div class="col s12 l9">
            <div class="row" style="background-color: #fff; margin: 0 2px">
                <div class="tool-wrapper">
                    <div class="toolbar">
                        <!--Сортировка товара-->
                        <div class="input-field col s12 m4">
                            <div class="sorting">
                                <select class="browser-default1" v-model="params" @change="sortByDifferentParams(params)" ref="items">
                                    <option value="" disabled selected>Выберите опцию</option>
                                    <option v-for="option in sortedItems"
                                            :key="option.value"
                                            :value="option.value"
                                    >{{option.name}}
                                    </option>
                                </select>
                                <label>Сортировка товаров</label>
                            </div>
                        </div>



                        <div class="input-field col s12 m4 center-align">
                            <div class="waves-effect waves-light btn" @click="ResetFilters">Сброс фильтров</div>
                        </div>

                        <!--количество элементов на странице-->
                        <div class="input-field col s12 m4 right">
                            <div class="item-on-page">
                                <select class="browser-default1" v-model="selected" @change="changeItemsOnPage(selected)" ref="sort" >
                                    <option value="" disabled selected>Выберите кол-во</option>
                                    <option v-for="item in itemsOnPage"
                                            :value="item"
                                    > {{item}}
                                    </option>
                                </select>

                                <label>Кол-во элементов на странице</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <loader v-if="loader"/>

                <h3 class="no-products" v-else-if="!getProducts.length">Товары отсутствуют!</h3>

                <!--Продукты-->

                <ProductItem
                    v-else
                    v-for = "(product,index) in getProducts" :key="product.id"
                    :product = "product"
                    :index = "index"
                    @addToCartData = addToCartParent

                />

            </div>
        </div>

        <!--Пагинация-->
        <div class="col s12 center-align">

            <ul class="pagination">
                <!-- предидущая -->
                <li :class="[{disabled: getPagination.prev_page_url === null}]">
                    <a href=""
                       @click.prevent = "optionViewProducts({page_url: getPagination.prev_page_url})"
                    > <i class="material-icons">chevron_left</i>
                    </a>
                </li>

                <!-- страницы -->
                <li v-for="page of getPagination.pages"
                    :class="[{active: getPagination.current_page == page.label}]"
                >
                    <a href="" @click.prevent = "optionViewProducts( {page_url: page.url})"> {{page.label}} </a>
                </li>

                <!-- следующая -->
                <li class="waves-effect"
                    :class="[{disabled: getPagination.next_page_url === null}]"
                >
                    <a href=""
                       @click.prevent = "optionViewProducts({page_url: getPagination.next_page_url})"
                    >
                        <i class="material-icons">chevron_right</i>
                    </a>
                </li>
            </ul>
        </div>
    </div>

</template>

<script>
import ProductItem from "./ProductItem";
import Loader from "../../Auxiliary/Loader";
import {mapActions, mapGetters} from 'vuex'

export default {
    name: "Products",
    components: {
        Loader, ProductItem,
    },
    data: () => ({
        currency_id: '',
        pagination: {},
        loader: true,
        itemsOnPage: [6, 9, 12, 25, 50],
        sortedItems: [
            {name: 'По умолчанию', value: '0' },
            {name: 'Имени (A - Z)', value: '1' },
            {name: 'Имени (Z - A)', value: '2' },
            {name: 'Цене (по возр.)', value: '3' },
            {name: 'Цене (по убыв.)', value: '4' },
        ],
        selected: '6',
        params: '0',
        profile: [],

    }),
    methods: {
        ...mapActions([
            'loadProducts',
            'addProductsToCart',
            'optionViewProducts'
        ]),

        ResetFilters() {
            this.loadProducts()

            this.selected = '6'
            this.params = '0'
            setTimeout(() => {
                M.AutoInit();
            },200)
        },

        //привязан к дочернему (data отуда)
        addToCartParent(product, index, currency){

            this.addProductsToCart({product, currency})
                .then(resp => {
                    if (!resp) {
                        this.$toasted.show(`Товар ${product.name} добавлен успешно!`,{
                            type: 'success',
                            position: "bottom-left",
                        })
                    } else {
                        this.$toasted.show(`Товар ${product.name} закончился`,{
                            type: 'error',
                            position: "bottom-left",
                        })
                    }
                })
        },

        changeItemsOnPage(countItems) {
            this.optionViewProducts({itemsOnPage: countItems})
        },

        sortByDifferentParams(value) {
            this.optionViewProducts({sortParam: value})
        },

    },
    computed: {
        ...mapGetters([
            'getProducts',
            'getPagination',
        ]),
    },
    mounted() {
        this.loadProducts().then((response) => {
            if (response.data.length){
                this.loader = false
            }
        });
    }
}
</script>

<style scoped>
    .no-products{
        text-align: center;
    }

</style>
