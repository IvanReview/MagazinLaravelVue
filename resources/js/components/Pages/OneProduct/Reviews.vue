<template>
    <div id="test2" class="col s12">
        <div id="tab-reviews" class="tab-content tab-rev clearfix">
            <div class="col s12 l7">
                <div class="no-review" v-if="!comments_arr.length">
                    <p>Отзывов пока нет, будьте первым!!!</p>
                </div>

                <div class="review-content" v-else>
                    <ul class="review">
                        <div class="comment-wrapper" v-for="comment in comments_arr">
                            <li class="review-item" >
                                <div class="images">
                                    <img :src="comment.user_id ?`/storage/${authorOfComment(comment).image}`:'/img/avata-01.jpg'" alt="">
                                </div>
                                <div class="review-text">
                                    <div class="">
                                        <h3 class="name"><span>{{comment.name}}</span></h3>
                                        <div class="des-rev">{{comment.text}}</div>
                                    </div>

                                    <div class="button-wrapper">
                                        <div class="time">{{comment.created_at| dateFilter}}</div>
                                    </div>
                                    <button class="btn-small" @click="setReplyingTo(comment)">
                                        <i class="material-icons left">reply</i>
                                        ответить
                                    </button>
                                </div>
                            </li>
                            <!--Дочернии комментарии-->
                            <li class="review-item child" v-for="comm in comment_status_filter(comment.replies)">
                                <div class="images">
                                    <img :src="comm.user_id ?`/storage/${authorOfComment(comm).image}`:'/img/avata-02.jpg'" alt="">
                                </div>
                                <div class="review-text">
                                    <div class="">
                                        <h3 class="name"><span>{{comm.name}}</span></h3>
                                        <div class="des-rev">{{comm.text}}</div>
                                    </div>

                                    <div class="button-wrapper">
                                        <div class="time">{{comm.created_at| dateFilter}}</div>
                                    </div>
                                    <button class="btn-small" @click="setReplyingTo(comment)">
                                        <i class="material-icons left">reply</i>
                                        ответить
                                    </button>
                                </div>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>

            <!-- Форма комментариев-->
            <div class="col s12 l5">
                <div class="form-review">
                    <h3 class="form-rev">
                        <span>Оставьте свой отзыв</span>
                    </h3>
                    <form class="comment-form" ref="form" @submit.prevent="commentAdd">
                        <input type="text" size="30"
                               placeholder="Ваше имя*"
                               ref="inputName"
                               v-model="comment.name"
                        >
                        <span class="helper-text invalid"
                              v-if="errorsComment.name"
                        >
                            {{ errorsComment.name[0] }}
                        </span>
                        <textarea class="materialize-textarea"
                                  placeholder="Сообщение *"
                                  v-model="comment.text"
                        ></textarea>
                        <span class="helper-text invalid"
                              v-if="errorsComment.text"
                        >
                            {{ errorsComment.text[0] }}
                        </span>
                        <!--<div class="submit">
                            <div class="rating-rev">
                                <div class="rating-star">
                                    <input type="radio" name="star-horizontal-rating" id="star-horizontal-rating-1">
                                    <label for="star-horizontal-rating-1"><i class="fa fa-star"></i></label>
                                    <input type="radio" name="star-horizontal-rating" id="star-horizontal-rating-2">
                                    <label for="star-horizontal-rating-2"><i class="fa fa-star"></i></label>
                                    <input type="radio" name="star-horizontal-rating" id="star-horizontal-rating-3">
                                    <label for="star-horizontal-rating-3"><i class="fa fa-star"></i></label>
                                    <input type="radio" name="star-horizontal-rating" id="star-horizontal-rating-4">
                                    <label for="star-horizontal-rating-4"><i class="fa fa-star"></i></label>
                                    <input type="radio" name="star-horizontal-rating" id="star-horizontal-rating-5">
                                    <label for="star-horizontal-rating-5"><i class="fa fa-star"></i></label>
                                </div>
                            </div>-->
                        <div class="subreview">
                            <button type="submit" class="btn" ref="btnSubmit">
                                <i class="material-icons left">comment</i>
                                <span>Добавить отзыв</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import {mapActions, mapGetters} from "vuex";
import * as buttons from "../../../helpers/load_buttons";
import * as auth from "../../../helpers/http_service";

export default {
    name: "Reviews",
    data: function() {
        return {
            loader: true,
            comments: {},
            comment: this.comment_prop,
            replyingTo: {},
            btnOldHtml: '',
            errorsComment: [],
            test: this.comments_prop[0]
        }
    },
    props: {
        comment_prop: {},
        comments_prop: {},
        users_prop: {},
        prodId_prop: ''
    },
    computed: {
        ...mapGetters([
            'getErrorsWriteComment',
        ]),

        comments_arr() {
            this.comments = this.comments_prop
            return this.comments
        }
    },
    methods: {
        ...mapActions([

        ]),

        authorOfComment(comment) {
            let user = this.users_prop.find(user => user.id === comment.user_id)
            return user
        },

        //установить параметры ответа на комментарий
        setReplyingTo(comment) {
            this.comment.parent_id = comment.id
            this.replyingTo = comment

            //подвинуть форму и сфокусировать
            this.$refs.form.scrollIntoView({behavior: "smooth", block: "center"});
            setTimeout(() => {
                this.$refs.inputName.focus()
            },200)
        },

        //статус комментария
        comment_status_filter(comments) {
            return comments.filter((comment)=> Number(comment.status) !== 0)
        },

        //добавить в базу
        commentAdd() {

            buttons.disableSubmission(this.$refs.btnSubmit)
            axios({
                method: 'POST',
                url: `/api/product/${this.prodId_prop}/comment`,
                data: this.comment,
            })
                .then((response) => {

                    buttons.enableSubmission(this.$refs.btnSubmit)

                    if (! this.replyingTo.id) {
                        this.comments.push(response.data)
                    } else {
                        //дочерний коммент
                        let index = this.comments.findIndex(item => item.id === response.data.parent_id)
                        this.comments[index].replies.push(response.data)
                    }

                    //очистка данных
                    this.comment.text = ''
                    this.comment.parent_id = '0'
                    this.errorsComment = []
                    this.replyingTo = {}

                    this.$toasted.show(`Комментарий успешно добавлен`,{
                        position: "bottom-left",
                    })
                })
                .catch((error) => {
                    buttons.enableSubmission(this.$refs.btnSubmit)
                    this.errorsComment = error.response.data.errors

                })
        },
    },

    mounted() {
        if (auth.getProfile() !== null) {
            this.comment.user_id = auth.getProfile().id
            this.comment.name = auth.getProfile().name
        }
    }

}
</script>

<style scoped>
    .child {
        margin-left: 100px;
    }

    .disabled {
        pointer-events: none;
        opacity: 0.4;
    }
    .review-text {
        width: 100%;
    }
    .review-item{
        border: 1px solid rgba(192,192,192, 0.4);
        padding: 10px;
        margin-bottom: 10px;
    }
    #test2{
        padding-bottom: 40px;
    }
    .images img {
        width: 70px;
    }

</style>
