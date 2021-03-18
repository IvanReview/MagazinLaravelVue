<template>
    <div class="main-content">
        <div class="page-title">
            <h3 class="center-align category">Пользователи</h3>
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
                                            <i class="material-icons ">swap_vertical_circle</i> Управление Пользователями
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!--Загрузчик-->
                <loader v-if="loader"/>

                <div class="table" v-else>
                    <table class="striped centered responsive-table admin-table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Имя</th>
                            <th>Телефон</th>
                            <th>Email</th>
                            <th>Дата Регистрации</th>
                            <th>Роль</th>
                            <th>Действие</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr v-for="(user,index) in getUsers">
                            <td>{{user.id}}</td>
                            <td>{{user.name}}</td>
                            <td>{{user.phone}}</td>
                            <td>{{user.email}}</td>
                            <td>{{user.created_at |  dateFilter}}</td>
                            <td>{{user.role}}</td>
                            <td>
                                <a href="#modal1"
                                   class="btn waves-effect waves-light light-blue accent-3 modal-trigger"
                                   type="submit"
                                   @click="openUserData(user,index)"
                                >
                                    <i class="material-icons">loupe</i>
                                </a>

                                <button class="btn waves-effect waves-light pink darken-1"
                                        type="submit"
                                        @click=""
                                >
                                    <i class="material-icons">delete</i>
                                </button>

                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <ModalUserEdit
                    :user_data="userEdit"
                    :user_index="userIndex"
                />


            </div>
        </section>


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
import Loader from "../../Auxiliary/Loader";
import axios from "axios";
import * as auth from "../../../helpers/http_service";
import ModalUserEdit from "./ModalUserEdit";
import {mapActions, mapGetters} from "vuex";
export default {
    name: "Users",
    data: ()=>({
        users: {},
        product_in_order: [],
        loader: true,
        userEdit: [],
        userIndex: '',

    }),
    computed: {
        ...mapGetters([
            'getUsers'
        ]),

    },
    methods: {
        ...mapActions([
            'receiveUsers',
        ]),

        fetchUsers() {
            this.receiveUsers().then((response) => {
                if (response) {
                    this.loader = false
                }
            })
        },

        openUserData(user,index) {
            this.userEdit = user
            this.userIndex = index

            setTimeout(()=>{
                M.FormSelect.init(this.$refs.selectUserRole);
                window.M.updateTextFields()
            },1000)

        },


    },
    mounted() {
        this.fetchUsers()

    },
    components: {ModalUserEdit, Loader}
}
</script>

<style scoped>

</style>
