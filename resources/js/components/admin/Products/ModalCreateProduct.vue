<template>
    <form @submit.prevent="createProduct">
        <div id="modal3" class="modal modal-fixed-footer" ref="modal3">
            <div class="row">
                <div class="modal-content">
                    <h4 class="category__create">Создать Продукт</h4>

                    <div class="row">
                        <div class="input-field col s12">
                            <label for="name">Имя Продукта</label>
                            <input name="first-name" type="text"
                                   placeholder="Введите Имя.."
                                   class="input-text"
                                   id="name" required=""
                                   v-model="productCreate.name"
                            >
                            <span class="helper-text invalid"
                                  v-if="getErrorsCreateProduct.name"
                            >
                                {{getErrorsCreateProduct.name[0]}}
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">

                            <select v-model="productCreate.category_id" class="browser-default" ref="selectCat">
                                <option value="" disabled selected> Выберите категорию</option>

                                <option v-for="category in child_categories"
                                        :value="category.id"
                                        :key="category.id"
                                >
                                    {{category.name}}
                                </option>


                            </select>
                            <!--<label>Название Категории</label>-->

                            <span class="helper-text invalid"
                                  v-if="getErrorsCreateProduct.category_id"
                            >
                                {{getErrorsCreateProduct.category_id[0]}}
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <label for="code">Код Продукта</label>
                            <input name="first-name" type="text"
                                   placeholder="Введите Код.."
                                   class="input-text"
                                   id="code" required=""
                                   v-model="productCreate.code"
                            >
                            <span class="helper-text invalid"
                                  v-if="getErrorsCreateProduct.code"
                            >
                                {{getErrorsCreateProduct.code[0]}}
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                                <textarea id="textarea1"
                                          class="materialize-textarea browser-default"
                                          v-model="productCreate.description"
                                          placeholder="Введите описание.."
                                ></textarea>
                            <label for="textarea1">Описание Продукта</label>
                            <span class="helper-text invalid"
                                  v-if="getErrorsCreateProduct.description"
                            >
                                {{getErrorsCreateProduct.description[0]}}
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <label for="code">Цена</label>
                            <input name="first-name" type="text"
                                   placeholder="Введите Цену.."
                                   class="input-text"
                                   id="price" required=""
                                   v-model="productCreate.price"
                            >
                            <span class="helper-text invalid"
                                  v-if="getErrorsCreateProduct.price"
                            >
                                {{getErrorsCreateProduct.price[0]}}
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <label for="count">Количество</label>
                            <input name="first-name" type="text"
                                   placeholder="Введите количество.."
                                   class="input-text"
                                   id="count" required=""
                                   v-model="productCreate.count"
                            >
                            <span class="helper-text invalid"
                                  v-if="getErrorsCreateProduct.count"
                            >
                                {{getErrorsCreateProduct.count[0]}}
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s12">
                            <label><strong>Выберите главное изображение:</strong></label>
                            <div v-if="productCreate.image" class="product__img">
                                <img src="" ref="newProductImageDisplay"/>
                            </div>

                            <div class="file-field input-field ">
                                <div class="btn">
                                    <span>File</span>
                                    <input type="file"
                                           ref="newProductImage"
                                           v-on:change="attachImageCreateProduct"
                                    >
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate"
                                           type="text"
                                           value=""
                                           ref="newProductImage2"
                                    >
                                </div>
                                <span class="helper-text invalid" v-if="getErrorsCreateProduct.image">
                                    {{getErrorsCreateProduct.image[0]}}
                                </span>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col s12">
                            <label><strong>Галерея изображений(удаление по клику):</strong></label>

                            <div class="gallery_container"  v-if="flag">
                                <div class="vg-dotted-square vg-center empty_container" ref="empty_container"></div>
                                <div class="vg-dotted-square vg-center empty_container" ref="empty_container"></div>
                                <div class="vg-dotted-square vg-center empty_container" ref="empty_container"></div>
                                <div class="vg-dotted-square vg-center empty_container" ref="empty_container"></div>
                                <div class="vg-dotted-square vg-center empty_container" ref="empty_container"></div>
                                <div class="vg-dotted-square vg-center empty_container" ref="empty_container"></div>
                                <div class="vg-dotted-square vg-center empty_container" ref="empty_container"></div>
                                <div class="vg-dotted-square vg-center empty_container" ref="empty_container"></div>
                            </div>


                            <!--Форма добавления файла-->
                            <div class="file-field input-field ">
                                <div class="btn">
                                    <span>Файлы для галлереи</span>
                                    <input type="file"
                                           ref="newProductImageGallery"
                                           v-on:change="attachImageCreateProductGallery"
                                           multiple
                                    >
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate"
                                           type="text"
                                           value=""
                                           ref="newProductImageGallery2"
                                           name="gallery_img"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <div class="modal-footer">
                <a href="" @click.prevent="" class="modal-close btn-flat pink darken-1 white-text">
                    <i class="material-icons right">close</i>Закрыть
                </a>
                <button class="btn waves-effect waves-light deep-purple darken-4" @click.prevent="createProduct" type="submit">
                    <i class="material-icons right">send</i> Создать
                </button>
            </div>
        </div>
    </form>

</template>

<script>
    import {mapActions, mapGetters} from 'vuex'
    import CategoryTreeItem from "./particles/categoryTreeItem";
    export default {
        name: "ModalCreateProduct",
        components: {CategoryTreeItem},
        props: {
            categories: {},

        },
        data() {
            return {
                productCreate: {
                    name: '',
                    category_id: '',
                    image: '',
                    code: '',
                    description: '',
                    price: '',
                    count: '',
                    gallery_img: [],
                },
                modalInstanceCreateProduct: null,
                fileStore: [],
                flag: true
            }
        },
        watch: {
            fileStore() {
                this.productCreate.gallery_img  = this.fileStore.filter((file) => file !== "undefined")
            }
        },
        methods: {
            ...mapActions([
                'loadProductsForAdmin',
                'loadCategoriesForAdmin',
                'productCreateAdmin',
                'productDeleteAdmin',
                'loadProducts',
            ]),

            //показать главное изображение после загрузки
            attachImageCreateProduct() {
                //ложим файл изображения
                this.productCreate.image = this.$refs.newProductImage.files[0];

                //чтение и загрузка файла в ДОМ элемент src
                let reader = new FileReader();
                reader.readAsDataURL(this.productCreate.image)
                reader.addEventListener('load',  () => {
                    this.$refs.newProductImageDisplay.src = reader.result;
                });

            },

            //показать изображения галлереи после загрузки
            attachImageCreateProductGallery() {

                let files = this.$refs.newProductImageGallery.files

                let parentContainer = document.querySelector('.gallery_container')
                let container = parentContainer.querySelectorAll('.empty_container')


                //если количество файлов > количества контейнеров добавляем еще
                if(container.length < files.length){

                    for (let index = 0; index < files.length - container.length; index++){

                        let el = document.createElement('div')
                        el.classList.add('vg-dotted-square', 'vg-center', 'empty_container')
                        parentContainer.append(el)
                    }
                    container = parentContainer.querySelectorAll('.empty_container')
                }

                for (let i in files) {
                    if (files.hasOwnProperty(i)){

                        let addElemId = this.fileStore.push(files[i]) - 1

                        this.showImageGallery(files[i], container[i])

                        this.deleteDisplayImage(addElemId, container[i])
                    }
                }
            },

            //непосредственно отображение изображения галлереи
            showImageGallery(file, container) {
                let reader = new FileReader()

                //содержимое контейнера удаляем
                container.innerHTML = ''

                reader.readAsDataURL(file);

                reader.onload = function(e) {

                    //внутри контейнера создаем тег img
                    container.innerHTML = '<img class="img_item" style="width: 70px" src="">'

                    //вставляем в img файл
                    container.querySelector('img').setAttribute('src', reader.result)

                    container.classList.remove('empty_container')

                };

            },

            //удалить изображение по клику
            deleteDisplayImage(addElemId, container){

                container.addEventListener('click',  () => {

                    //сносим контаинер
                    container.remove()

                    //и файл из переменной
                    delete this.fileStore[addElemId]

                    this.productCreate.gallery_img  = this.fileStore.filter((file) => file !== "undefined")
                })
            },

            //создание продукта
            createProduct() {

                let formData = new FormData();
                formData.append('name', this.productCreate.name)
                formData.append('code', this.productCreate.code)
                formData.append('description', this.productCreate.description)
                formData.append('category_id', this.productCreate.category_id)
                formData.append('price', this.productCreate.price)
                formData.append('count', this.productCreate.count)
                formData.append('image', this.productCreate.image)

                let key = 'gallery_img';
                this.productCreate.gallery_img.forEach((item, index) => {

                    formData.append(`${key}[${index}]`, item)
                })

                this.productCreateAdmin(formData)
                    .then(resp => {
                        if (resp.status === 200) {
                            this.$toasted.show('Продукт успешно создан!',{
                                type: 'success',
                            })

                            //очистка формы
                            this.fileStore = []
                            this.productCreate = {
                                image: '',
                            }
                            this.$refs.newProductImage2.value = ""
                            this.$refs.newProductImage2.classList.remove('valid')

                            this.$refs.newProductImageGallery2.value = ''
                            this.$refs.newProductImageGallery2.classList.remove('valid')
                            let block = document.querySelectorAll('.vg-dotted-square')
                            for (let i in block) {
                                if (block.hasOwnProperty(i)){
                                    if (block[i].querySelector('img'))
                                        block[i].querySelector('img').src = ''
                                }
                            }


                            this.modalInstanceCreateProduct.close()
                        } else if (resp === 422) {
                            this.$toasted.show('Заполните правильно данные!',{
                                type: 'error',
                            })
                        }
                    })

            }
        },
        computed: {
            ...mapGetters([
                'getProductsAdmin',
                'getErrorsCreateProduct',
                'getCategoriesAll'
            ]),

            child_categories() {
                let cat = this.categories.filter((item) => {
                    return Number(item.parent_id) !== 0
                })
                return cat
            },



        },
        mounted() {
            this.modalInstanceCreateProduct = window.M.Modal.init(this.$refs.modal3);

            setTimeout(()=>{
                M.FormSelect.init(this.$refs.selectCat);
                window.M.updateTextFields()
            },500)
        }
    }
</script>

<style scoped>
    .input-field{
        margin-bottom: 0;
    }

    .input-field > label{
        color: #d6a279;
        font-size: 20px;
    }

    .product__img{
        width: 200px;
    }

    .modal {
        max-height: 85% !important;
    }
    .modal.modal-fixed-footer {
        height: 85% !important;
    }




</style>
