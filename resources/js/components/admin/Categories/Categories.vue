<template>
    <div class="main-content">
        <div class="page-title">
            <h3 class="center-align category">Категории</h3>
        </div>

        <section>
            <div class="row" >

                <!--Карточка-->

                <div class="row">
                    <div class="col s12 l12">
                        <div class="card">
                            <div class="card-content">
                                <div class="row category__card">
                                    <div class="col s6">
                                        <p class="category-create__text">
                                            <i class="material-icons">swap_vertical_circle</i> Управление категориями
                                        </p>
                                    </div>
                                    <div class="col s6 right-align">
                                        <a href="#modal1" class="btn modal-trigger waves-effect waves-light">
                                            <i class="material-icons left">add</i> Создать категорию
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Создание категорий -->
                <modal-create-category
                    :categories_data="getCategoriesForAdmin"
                />

                <!-- Modal Редактирования категорий -->
                <modal-edit-category
                    :category_data = categoryEdit
                />

                <loader v-if="loader"/>

                <div class="row" v-else>
                    <div class="col s12">
                        <div class="table">
                            <table class="striped responsive-table admin-table">
                                <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Имя</th>
                                    <th>Родительская Категория</th>
                                    <th>Код</th>
                                    <th>Описание</th>
                                    <th>Изображение</th>
                                    <th>Действие</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr v-for="(category, index) in getCategoriesForAdmin">
                                    <td>{{ index+1 }}</td>
                                    <td>{{ category.name }}</td>
                                    <td> {{parentCategoryName(category.parent_id)}} </td>
                                    <td>{{ category.code }}</td>
                                    <td>{{ category.description }}</td>
                                    <td class="category__img">
                                        <img :src="category.image ? `/storage/${category.image}` : `/storage/no_photo.jpg`"
                                             :alt="category.name"
                                        >
                                    </td>
                                    <td>
                                        <a  href="#modal2"
                                            class="btn waves-effect waves-light light-blue darken-2 modal-trigger"
                                            @click.prevent="editCategory(category)"
                                        >
                                            <i class="material-icons">edit</i>
                                        </a>

                                        <button class="btn waves-effect waves-light pink darken-1"
                                                @click="deleteCategory(category.id, index)"
                                        >
                                            <i class="material-icons">delete</i>
                                        </button>

                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="center-align" v-show="getPaginateForCategories.moreExists">
                    <button type="button" class="btn " @click="loadMore">
                        <i class="material-icons left">arrow_downward</i>
                        Загрузить исчо
                    </button>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import ModalCreateCategory from "./ModalCreateCategory";
    import ModalEditCategory from "./ModalEditCategory";
    import {mapActions, mapGetters} from 'vuex'
    import Loader from "../../Auxiliary/Loader";

    export default {
        name: "Categories",
        data: () => ({
            modalInstance: null,
            categoryEdit: {},
            loader: true,

            moreExists: true,
            nextPage: 0
        }),
        methods: {
            ...mapActions([
                'loadCategories',
                'loadMoreCategories',
                'categoryDeleteAdmin',
                'loadCategoriesForAdmin'
            ]),

            parentCategoryName(parent_id) {
                if (parent_id == 0 ){
                    return "Корневая категория"
                }
                let cat_name =  this.getCategories.find(cat => cat.id == parent_id && parent_id != 0)

                return cat_name.name
            },

            loadMore() {
                this.loadMoreCategories()
            },

            editCategory(category) {
                this.categoryEdit = category
            },

            deleteCategory(categoryId, index) {
                if (confirm("Вы уверены??")){
                    this.categoryDeleteAdmin({categoryId: categoryId, index: index})
                        .then(resp => {
                            this.$toasted.show(`Категория успешно удалена!`,{
                                type: 'info',
                            })
                        })
                }
            }
        },
        mounted() {
            this.loadCategories();

            setTimeout(()=>{
                this.loadCategoriesForAdmin().then((resp)=>{
                    this.loader = false
                })
            },400)


        },
        destroyed() {
            if (this.modalInstance && this.modalInstance.destroy){
                this.modalInstance.destroy();
            }
        },
        computed: {
            ...mapGetters([
                'getCategoriesForAdmin',
                'getPaginateForCategories',
                'getCategories'
            ]),
        },
        components: {
            Loader,
            ModalCreateCategory,
            ModalEditCategory
        }
    }
</script>

<style >
    .main-content {
        padding: 0 40px;
    }

    .category-create__text{
        font-size: 25px;
    }
    .input-field{
        margin-bottom: 0;
    }

    .input-field > label{
        font-size: 1.2rem;
    }

    .admin-table tr {
        border-bottom: 1px solid rgba(0,0,0,0.12);
        background-color: #fff;
    }
    .admin-table{
        background-color: #fff;
    }
    .category__img img{
        width: 150px;
    }
    .category__card{
        margin-bottom: 0;
    }

    .helper-text.invalid{
        color:#f44336
    }
    .admin-table th,td {
        padding-left: 15px;

    }
</style>
