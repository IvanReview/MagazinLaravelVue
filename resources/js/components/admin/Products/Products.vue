<template>
    <div class="main-content">
        <div class="page-title">
            <h3 class="center-align category">Продукты</h3>
        </div>

        <section>
            <div class="row" >

                <div class="row">
                    <div class="col s12 l12">
                        <div class="card">
                            <div class="card-content">
                                <div class="row mb-0">
                                    <div class="col s6">
                                        <p class="category-create__text">
                                            <i class="material-icons ">swap_vertical_circle</i> Управление продуктами
                                        </p>
                                    </div>
                                    <div class="col s6 right-align">
                                        <a  href="#modal3"
                                            class="btn waves-effect waves-light deep-purple darken-4 modal-trigger"
                                        >
                                            <i class="material-icons left">add</i> Создать продукт
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!--Модальное окно создания продукта-->
                <modal-create-product
                    :categories = "getCategoriesAll"
                />

                <!--Модальное окго редактирования продукта-->
                <modal-edit-product
                    :product_data="productEdit"
                />

                <loader v-if="loader"/>

                <div class="table" v-else>
                    <table class="striped responsive-table admin-table centered">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>Имя</th>
                            <th>Категория</th>
                            <th>Код</th>
                            <th>Описание</th>
                            <th>Цена</th>
                            <th>Кол-во</th>
                            <th>Изображение</th>
                            <th>Действие</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr v-for="(product, index) in getProductsAdmin">
                            <td>{{index +1}}</td>
                            <td>{{product.name}}</td>
                            <td>{{findCategoryName(product.category_id)}}</td>
                            <td>{{product.code}}</td>
                            <td>{{product.description}}</td>
                            <td>${{product.price}}</td>
                            <td>{{product.count}}</td>
                            <td class="product__img">
                                <img :src="product.image ? `/storage/${product.image}` : `/storage/no_photo.jpg`"
                                     :alt="`${product.image}`"
                                >

                            </td>
                            <td>
                                <a href="#modal4"
                                   class="btn waves-effect waves-light deep-orange darken-2 modal-trigger"
                                   @click.prevent="editProduct(product)"
                                >
                                    <i class="material-icons">edit</i>
                                </a>

                                <button class="btn waves-effect waves-light pink darken-1"
                                        @click="deleteProduct(product.id, index)"
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

        <!--Пагинация-->
        <div class="col s12 center-align pagination-admin">

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
        </div>
    </div>
</template>

<script>
    import {mapGetters,mapActions} from 'vuex'
    import ModalCreateProduct from "./ModalCreateProduct";
    import ModalEditProduct from "./ModalEditProduct";
    import Loader from "../../Auxiliary/Loader";

    export default {
        name: "Product",
        data: () => ({
            modalInstance: null,
            productEdit: {},
            loader: true
        }),
        methods: {
            ...mapActions([
                'loadProductsForAdmin',
                'productCreateAdmin',
                'productDeleteAdmin',
                'loadProducts',
                'productUpdateAdmin',
            ]),

            findCategoryName(category_id){
                let category = this.getCategoriesAll.find(item => Number(item.id) === Number(category_id));
                return category.name
            },


            editProduct(product) {
                this.productEdit = product

            },
            deleteProduct(productId, index) {
                if (confirm('Вы уверенны??')){
                    this.productDeleteAdmin({productId: productId, index: index})
                        .then(resp => {
                            this.$toasted.show(`Продукт успешно удален!`,{
                                type: 'error',
                            })
                        })
                }
            }
        },
        computed: {
            ...mapGetters([
                'getProductsAdmin',
                'getPaginationAdminProduct',
                'getErrorsEditProduct',
                'getCategoriesAll',
                'getCategoriesTree'
            ]),


        },
        mounted() {

            this.loadProductsForAdmin().then(resp => {
                if (resp.products.data.length){
                    this.loader = false
                }
            })


        },
        created() {

        },
        destroyed() {

        },
        components: {Loader, ModalEditProduct, ModalCreateProduct}
    }
</script>

<style >

    .main-content {
        padding: 0 40px;
    }

    .category-create__text{
        font-size: 25px;
    }
    .admin-table tr {
        border-bottom: 1px solid rgba(0,0,0,0.12) !important;
        background-color: #fff;
    }
    .admin-table{
        background-color: #fff;
    }
    .product__img img {
        width: 150px;
    }

    .table td {
        max-width: 250px;
    }
    .pagination-admin{
        margin-top: 40px

    }
    .helper-text.invalid{
        color:#f44336
    }

</style>
