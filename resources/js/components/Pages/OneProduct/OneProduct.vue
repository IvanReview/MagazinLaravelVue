<template xmlns="http://www.w3.org/1999/html">
    <section class="one-product">
        <div class="container">

            <div class="row">
                <div class="col s12 l6">
                    <div class="images-product">
                        <img class="materialboxed" :src="`/storage/${product.image}`" alt="prod" ref="main_img">
                    </div>

                <!--Галлерея-->
                    <div class="thumbs">
                        <div class="thumb"
                             v-for="image in gallery_images"
                             :key="image.id"
                             @click="showImage(image)"
                        >
                            <img :src="`/storage/${image.name}`" >
                        </div>
                    </div>
                </div>


                <div class="col s12 l6">
                    <div class="summary">
                        <h2 class="product-name"><a href="#">{{product.name}}</a></h2>

                        <div class="price">
                            <div><span class="amount">
                                {{product.price* getCurrency.currency_coefficient| currencyFilter(getCurrency.currency_code)}}
                            </span></div>
                            <div><span class="discount">
                                {{(product.price*1.2)*getCurrency.currency_coefficient| currencyFilter(getCurrency.currency_code) }}
                            </span></div>
                        </div>
                        <div class="des">
                            <p>{{product.description}}</p>
                        </div>
                        <div class="product-options">
                            <div class="sizes-product">
                                <strong>Размеры:</strong>
                                <a href="#"><span>XS </span></a>
                                <a href="#"><span>S </span></a>
                                <a href="#"><span>M </span></a>
                                <a href="#"><span>L </span></a>
                                <a href="#"><span>XL </span></a>
                            </div>
                            <div class="scolor-product">
                                <strong>Цвета: </strong>
                                <div class="colors">
                                    <div class="c-blue color blue"><span></span></div>
                                    <div class="c-gray color red"><span></span></div>
                                    <div class="c-purple color purple teal"><span></span></div>
                                    <div class="c-yellow color black"><span></span></div>
                                    <div class="c-red color purple"><span></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="quantity">
                            <label>Количество: </label>
                            <div class="minus qt" @click="decrementItem(product)"
                                 :class="{disabled: !productQuantity()}"
                            >
                                <i class="fa fa-minus"></i>
                            </div>

                            <div class="count"><span>{{productQuantity()}}</span></div>

                            <div class="qt plus" @click="incrementItem()"
                                    :class="{disabled: !productQuantity()}" >
                                <i class="fa fa-plus" disabled="disabled" ></i>
                            </div>
                        </div>
                        <div class="social social-product clearfix">
                            <div class="label-social">поделиться: </div>
                            <ul>
                                <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fab fa-pinterest"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fab fa-facebook-square"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fab fa-behance"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fab fa-dribbble"></i></a></li>
                            </ul>
                        </div>
                        <div class="buttons clearfix" v-if="! product.count">
                            <button class="button cart-button btn red" >
                                <i class="material-icons right">cancel</i> Товара нет в наличии
                            </button>
                        </div>
                        <div class="buttons clearfix" v-else>
                            <a class="button cart-button btn" href=" " @click.prevent="addToCart">
                                <i class="material-icons right">add</i> Добавить
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        <!--//акардеон-->
            <div class="tabs-container">
                <div class="row">
                    <div class="col s12">
                        <ul class="tabs">
                            <li class="tab col s3"><a href="#test1">Описание</a></li>
                            <li class="tab col s3"><a class="active" href="#test2">Отзывы</a></li>
                            <li class="tab col s3 last" ><a href="#test3">Теги</a></li>
                        </ul>
                    </div>

                    <div id="test1" class="col s12">
                        <div id="tab-description" class="tab-content tab-des clearfix" style="display: block;">
                            <h3>In a free hour, when our power of choice</h3>
                            <p>This is a custom CMS block. You can use it to display information about shipping, returns, refunds, latest promotions etc. Put any content you want here, like text, HTML, images or videos. There are many useful blocks like this one across the theme. All CMS blocks are editable from the admin panel. You can delete block static Custom Tab if you want.</p>
                            <p><span>Shipping:</span> Please allow about 5-10 business days for delivery. For delivery to Alaska or Hawaii, please allow 10-15 days for delivery. For delivery to PO Boxes in Alaska, Hawaii, US Territories and APO/FPO addresses, allow three weeks for delivery.</p>
                            <p><span>Backorders:</span> All backordered items will be shipped via Standard Delivery service at no additional charge.</p>
                            <p><span>Returns Policy:</span> You may return new, unworn or unused products within thirty (30) days of delivery for a full refund of the cost of the goods, or an exchange if</p>
                        </div>
                    </div>

                    <!--комментарии-->
                    <!--                    <div id="test2" class="col s12">
                        <div id="tab-reviews" class="tab-content tab-rev clearfix">
                            <div class="col s12 l7">
                                <div class="no-review" v-if="!comments.length">
                                    <p>Отзывов пока нет, будьте первым!</p>
                                </div>

                                <div class="review-content" v-else>
                                    <ul class="review">
                                        <div class="comment-wrapper" v-for="comment in comments">
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
                                            &lt;!&ndash;Дочернии комментарии&ndash;&gt;
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

                           &lt;!&ndash; Форма комментариев&ndash;&gt;
                            <div class="col s12 l5">
                                <div class="form-review">
                                    <h3 class="form-rev">
                                        <span>Оставьте свой отзыв</span>
                                    </h3>
                                    <form class="comment-form"  ref="form" @submit.prevent="commentAdd">
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
                                    &lt;!&ndash;<div class="submit">
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
                                        </div>&ndash;&gt;
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

                    </div>-->
                    <Reviews
                        :comment_prop="comment"
                        :comments_prop="comments"
                        :users_prop="users"
                        :prod-id_prop="prodId"
                    />

                    <div id="test3" class="col s12">
                        <div id="tab-add_tags" class="tab-content add-tags clearfix">
                            <h3 class="addtag"><span>Add Your Tags</span></h3>

                            <form method="post" action="#">
                                <input type="text" value="" placeholder="Your tags here">
                                <div class="add-tags"><a href="#"><span>Add Tags</span></a></div>
                                <p>Use spaces to separate tags. Use single quotes (') for phrases.</p>
                            </form>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </section>

</template>

<script>
import {mapActions, mapGetters} from "vuex";
import * as auth from '../../../helpers/http_service';
import * as buttons from "../../../helpers/load_buttons";
import Reviews from "./Reviews";


export default {
    name: "OneProduct",
    components: {Reviews},
    props: {

    },
    data: () =>({
        prodId: '',
        product: [],
        comments: {},
        loader: true,
        users: [],
        gallery_images: [],
        comment: {
            name: '',
            text: '',
            parent_id: '0',
            product_id: '',
            user_id: ''
        },
        btnOldHtml: '',

    }),
    beforeRouteEnter(to, from, next){
        next(vm => {
            vm.prodId = to.params.id
        })
    },
    computed: {
        ...mapGetters([
            'getProductsInCart',
            'getErrorsWriteComment',
            'getCurrency'
        ]),
    },
    methods: {
        ...mapActions([
            'incrementCart',
            'decrementCart',
            'deleteProductCart',
            'totalSumInCart',
            'addProductsToCart'
        ]),

        showImage(image) {
            this.$refs.main_img.src = `/storage/${image.name}`
        },

        productQuantity() {
            let productInCart =  this.getProductsInCart.find((product) => product.id == this.prodId )
            return productInCart ? productInCart.quantity : 0
        },

        fetchData() {
            axios.get(`/api/product/${this.prodId}`)
                .then(response => {

                    this.gallery_images = response.data.product.gallery_images
                    //добавит главное изображение в галлер, чтобы можно было перекл назад
                    this.gallery_images.push({id: Math.floor(Math.random()*100), name:response.data.product.image})

                    this.product = response.data.product
                    this.comments = response.data.comments
                    this.users = response.data.users
                    this.comment.product_id = response.data.product.id
                })
        },

        addToCart() {
            let product = this.product
            let currency = this.getCurrency

            this.addProductsToCart({product, currency})
                .then(resp => {
                    if (! resp) {
                        this.$toasted.show(`Товар ${this.product.name} добавлен успешно!`,{
                            type: 'success',
                            position: "bottom-left",
                        })
                    } else {
                        this.$toasted.show(`Товар ${this.product.name} закончился`,{
                            type: 'error',
                            position: "bottom-left",
                        })
                    }
                })

        },

        decrementItem(product) {
            let index =  this.getProductsInCart.findIndex((product) => product.id == this.prodId )
            this.decrementCart(index)
        },

        incrementItem() {
            let index =  this.getProductsInCart.findIndex((prod) => prod.id == this.prodId )
            let product = this.getProductsInCart.find((prod) => prod.id == this.prodId )

            //если число запрашиваемого товара <= кол на складе идем дальше иначе товар кончился
            if (product.quantity + 1 <= product.count) {
                this.incrementCart(index)
            } else {
                this.$toasted.show(`Увы товар ${product.name} закончился на складе!`,{
                    type: 'error',
                })
            }
        },


    },
    created() {

        this.prodId = window.location.href.split('/')[4]
        this.fetchData()

        setTimeout(()=> {
            M.AutoInit();
        },200)

    },
    mounted() {

    }
}
</script>

<style scoped>
    .images-product{
        border: 2px solid #d6a279;
        background-color: #fff;
    }
    .images-product img {
        max-width: 500px;
        max-height: 700px;
    }

    .images img {
        width: 70px;
    }

    .thumbs {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin: 30px 0;
    }
    .thumbs .thumb {
        max-height: 150px;
        display: flex;
        text-align: center;
        align-items: center;
        max-width: 90px;
        border: 1px dashed teal;
        margin: 7px 7px;
        min-width: 80px;
        background-color: #fff;

    }

    .thumbs .thumb img {
       max-width: 100%;
    }
</style>
