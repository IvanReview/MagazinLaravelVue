<template>
    <div class="col s12 l3">
        <div id="sidebar" class="sidebar left-sidebar">

            <aside class="widget">
                <h3 class="widget-title">Категории</h3>

                <ul class="collapsible expandable">
                    <li @click.prevent="loadAllProduct"
                        class="active"
                    >
                        <div class="collapsible-header">Все категории</div>
                        <div class="collapsible-body"><span>Товары всех категорий</span></div>
                    </li>

                    <li v-for="category in getCategories" :key="category.id">
                        <div class="collapsible-header">{{category.name}}
                            <i class="material-icons">arrow_drop_down</i>
                        </div>
                        <div class="collapsible-body">
                            <ul>
                                <li  v-for="(cat, index)  in category.children_cat"
                                     :key="index"
                                     @click.prevent="sortByCategory(cat, index)"
                                     class="category__list category-link"
                                     :class="{active: activeIndex === index+1}"
                                >
                                    <div class="category__child">{{cat.name}}</div>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </aside>

            <!-- Слайдер -->
            <aside class="widget">

                <h3 class="widget-title">Фильтр по цене</h3>

                <div class="f-price">
                    <div id="test-slider"></div>

                    <div class="f-price__column">
                        <button class="btn btn-dashed textup filter-btn" @click="filterPrice">фильтр</button>
                        <span class="amount">
                            {{ ((minPrice * getCurrency.currency_coefficient).toFixed(1)) | currencyFilter(getCurrency.currency_code)}} -
                            {{ ((maxPrice * getCurrency.currency_coefficient).toFixed(1)) | currencyFilter(getCurrency.currency_code)}}
                        </span>
                    </div>
                </div>

            </aside>

<!--            <aside class="widget">

                <h3 class="widget-title">By Brands</h3>

                <ul>

                    <li><a href="#">Hermes <span class="count">(20)</span></a></li>

                    <li><a href="#">Delce & Gabbana <span class="count">(16)</span></a></li>

                    <li><a href="#">Louis Vuitton <span class="count">(28)</span></a></li>

                    <li><a href="#">Versace <span class="count">(45)</span></a></li>

                    <li><a href="#">Hug Boss <span class="count">(12)</span></a></li>

                    <li><a href="#">Zara <span class="count">(33)</span></a></li>

                </ul>

            </aside>

            <aside class="widget">

                <h3 class="widget-title">By Colors</h3>

                <ul>

                    <li><a href="#">Red <span class="count">(120)</span></a></li>

                    <li><a href="#">White <span class="count">(65)</span></a></li>

                    <li><a href="#">Black <span class="count">(87)</span></a></li>

                    <li><a href="#">Blue <span class="count">(25)</span></a></li>

                </ul>

            </aside>

            <aside class="widget">

                <h3 class="widget-title">By Size</h3>

                <ul>

                    <li><a href="#">X - Small <span class="count">(20)</span></a></li>

                    <li><a href="#">Small <span class="count">(65)</span></a></li>

                    <li><a href="#">Medium <span class="count">(87)</span></a></li>

                </ul>

            </aside>-->

        </div>
    </div>
</template>

<script>
import noUiSlider from "materialize-css/extras/noUiSlider/nouislider";
import wNumb from "wnumb";
import {mapActions, mapGetters} from 'vuex'

export default {
    name: "Sidebar",
    data: () => ({
        activeIndex: 0,
        minPrice: 200,
        maxPrice: 1500,

    }),
    methods: {
        ...mapActions([
            'loadCategories',
            'loadProducts',
            'optionViewProducts'
        ]),

        //взять товары из всех категорий
        loadAllProduct(){
            //для класса active
            this.activeIndex = 0
            this.loadProducts()
        },

        //взять товары определенной категории
        sortByCategory(category, index) {
            this.activeIndex = index + 1
            this.optionViewProducts({categoryId: category.id})
        },

        filterPrice() {

            this.optionViewProducts({priceFrom: this.minPrice,priceTo: this.maxPrice })
        }

    },
    computed: {
        ...mapGetters([
            'getCategories',
            'getCurrency',
        ]),
    },
    mounted() {
        this.loadCategories()

        M.AutoInit();

        const slider = document.getElementById('test-slider');
        noUiSlider.create(slider, {
            start: [2000, 6000],
            connect: true,
            step: 200,
            orientation: 'horizontal',
            range: {
                'min': 0,
                'max': 8000
            },
            format: wNumb({
                decimals: 0
            })
        });
        slider.noUiSlider.on('update', (val, handle) => {
            this.minPrice = val[0]
            this.maxPrice = val[1]
        })
    }
}
</script>



<style scoped>
    .category__child{
        cursor: pointer;
    }
    .category__all{
        display: flex;
        cursor: pointer;
        -webkit-tap-highlight-color: transparent;
        line-height: 1.5;
        padding: 1rem;
        background-color: #fff;
        border-bottom: 1px solid #ddd;
    }
    .f-price__column {
        display: flex;
    }

    .f-price__column .amount{
        margin-left: 20px;

    }

    .f-price__column .filter-btn{
        margin-top: 7px;
    }

</style>
