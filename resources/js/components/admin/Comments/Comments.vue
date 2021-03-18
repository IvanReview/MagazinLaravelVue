<template>
    <div>
        <div class="row">
            <div class="col s12 l12">
                <div class="card">
                    <div class="card-content">
                        <div class="row category__card">
                            <div class="col s12">
                                <p class="category-create__text">
                                    <i class="material-icons left">swap_vertical_circle</i> Управление комментариями
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <loader v-if="loader"/>

        <div class="row" v-else>
            <div class="col s12">
                <div class="table">
                    <table class="striped responsive-table admin-table">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>Имя автора</th>
                            <th>Текст комментария</th>
                            <th>Продукт</th>
                            <th>Статус</th>
                            <th>Дата</th>
                            <th>Действие</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr v-for="(comment, index) in getComments">
                            <td>{{comment.id}}</td>
                            <td>{{comment.name}}</td>
                            <td class="comment__text">{{comment.text}}</td>
                            <td>{{comment.product.name}}</td>
                            <td><b>{{ Number(comment.status) ? "Опубликован" : "НЕ опубликован"}}</b> </td>
                            <td>{{comment.created_at|dateFilter}}</td>
                            <td class="comment__action">
                                <a  href="#modal1"
                                    class="btn waves-effect waves-light purple darken-4 modal-trigger"
                                    @click.prevent="editComment(comment)"
                                >
                                    <i class="material-icons">edit</i>
                                </a>

                                <button class="btn waves-effect waves-light pink darken-1"
                                        @click="deleteComment(comment.id, index)"
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

        <modal-comment-edit
            :comment_data="comment"
            v-if="load_modal"
        />

        <!--Пагинация-->
        <div class="col s12 center-align pagination-comment">

            <ul class="pagination">
                <li :class="[{disabled: getPaginateComment.prev_page_url === null}]">
                    <a href=""
                       @click.prevent="loadComments(getPaginateComment.prev_page_url)"
                    ><i class="material-icons">chevron_left</i>
                    </a>
                </li>

                <!--Страницы-->
                <li v-for="page of getPaginateComment.pages"
                    :class="[{active: getPaginateComment.current_page === page.label}]"
                >
                    <a href="" @click.prevent="loadComments( page.url)">{{page.label}}</a>
                </li>

                <li class="waves-effect"
                    :class="[{disabled: getPaginateComment.next_page_url === null}]"
                >
                    <a href=""
                       @click.prevent="loadComments(getPaginateComment.next_page_url)"
                    >
                        <i class="material-icons">chevron_right</i>
                    </a>
                </li>
            </ul>
        </div>

    </div>

</template>

<script>
import {mapActions, mapGetters} from "vuex";
import Loader from "../../Auxiliary/Loader";
import ModalCommentEdit from "./ModalCommentEdit";
import comment from "../../../store/comment";

export default {
    name: "Comments",
    components: {ModalCommentEdit, Loader},
    data: ()=>({
        comment: {},
        loader: true,
        load_modal: false,
        modalInstance: null,

    }),
    computed: {
        ...mapGetters([
            'getComments',
            "getPaginateComment",
        ]),

    },
    methods: {
        ...mapActions([
            'totalSumInCart',
            'loadComments',
            'acceptComment',
            'deleteCommentFromBd'
        ]),
        editComment(comment) {
            this.comment = comment

            this.load_modal = true
            setTimeout(()=>{
                window.M.updateTextFields()
            },200)
        },


        deleteComment(commentId, index) {
            if(confirm('Точно???')) {
                this.deleteCommentFromBd({commentId, index}).then((resp)=>{
                    this.$toasted.show('Комментарий удален!',{
                        type: 'error',
                    })
                })
            }
        }

    },
    mounted() {
        this.loadComments().then(resp => {
            if (resp){
                this.loader = false
            }
        })
        M.AutoInit()
    },

}
</script>

<style scoped>
    .comment__text{
        width: 300px;
    }
    .comment__action{
        width: 150px;
        max-width: 150px;
    }
    .pagination-comment .pagination .active{
        background-color: #4a148c !important;
    }
</style>
