<template>
    <form @submit.prevent="sendUpdateProduct(product_data)">
    <div id="modal4" class="modal modal-fixed-footer" ref="modal4">
        <div class="modal-content">
            <h4>Редактировать Продукт</h4>
            <div class="row">
                <div class="input-field col s12">
                    <label for="name">Имя Продукта</label>
                    <input name="first-name" type="text"
                           placeholder="Введите Имя.."
                           class="input-text"
                           id="name" required=""
                           v-model="product_data.name"
                    >
                    <span class="helper-text invalid"
                          v-if="getErrorsEditProduct.name"
                    >
                                {{getErrorsEditProduct.name[0]}}
                            </span>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">

                    <select v-model="product_data.category_id" class="browser-default" ref="selectProd">
                        <option value="" disabled selected> Выберите категорию</option>
                        <option v-for="category in child_categories"
                                :value="category.id"
                                :key="category.id"
                        >{{category.name}}
                        </option>
                    </select>
                    <!--<label>Название Категории</label>-->

                    <span class="helper-text invalid"
                          v-if="getErrorsEditProduct.category_id"
                    >
                                {{getErrorsEditProduct.category_id[0]}}
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
                           v-model="product_data.code"
                    >
                    <span class="helper-text invalid"
                          v-if="getErrorsEditProduct.code"
                    >
                                {{getErrorsEditProduct.code[0]}}
                            </span>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <textarea id="textarea1"
                              class="materialize-textarea browser-default"
                              v-model="product_data.description"
                              placeholder="Введите описание.."
                    ></textarea>
                    <label for="textarea1">Описание Продукта</label>
                    <span class="helper-text invalid"
                          v-if="getErrorsEditProduct.description"
                    >
                        {{getErrorsEditProduct.description[0]}}
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
                           v-model="product_data.price"
                    >
                    <span class="helper-text invalid"
                          v-if="getErrorsEditProduct.price"
                    >
                                {{getErrorsEditProduct.price[0]}}
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
                           v-model="product_data.count"
                    >
                    <span class="helper-text invalid"
                          v-if="getErrorsEditProduct.count"
                    >
                                {{getErrorsEditProduct.count[0]}}
                            </span>
                </div>
            </div>

            <div class="row">
                <div class="col s12">
                    <label><strong>Выберите изображение:</strong></label>
                    <div v-if="product_data.image" class="product__img">
                        <img :src="`/storage/${product_data.image}`" ref="editProductImageDisplay"/>
                    </div>


                    <div class="file-field input-field ">
                        <div class="btn">
                            <span>File</span>
                            <input type="file"
                                   ref="editProductImage"
                                   v-on:change="attachImageEditProduct"
                            >
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate"
                                   type="text"
                                   value=""
                                   ref="editProductImage2"
                            >
                        </div>
                        <span class="helper-text invalid" v-if="getErrorsEditProduct.image">
                            {{getErrorsEditProduct.image[0]}}
                        </span>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col s12">
                    <label><strong>Галерея изображений(удаление по клику):</strong></label>

                    <div class="gallery_container-edit">
                        <div class="vg-dotted-square vg-center"
                             ref="empty_container"
                             v-for="(image, index) in product_data.gallery_images"
                             @click="deleteDisplayImageForEditOld(index)"
                        >
                            <img v-if="" :src="`/storage/${image.name}`" class="img_item" style="width: 70px"/>

                        </div>

<!--                        <div class="vg-dotted-square vg-center empty_container-edit" ref="empty_container"></div>-->

                    </div>


                    <!--Форма добавления файла-->
                    <div class="file-field input-field ">
                        <div class="btn">
                            <span>Файлы для галлереи</span>
                            <input type="file"
                                   ref="editProductImageGallery"
                                   v-on:change="attachImageEditProductGallery"
                                   multiple
                            >
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate"
                                   type="text"
                                   value=""
                                   ref="editProductImageGallery2"
                                   name="gallery_img"
                            >
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="modal-footer">
            <a href="" @click.prevent="" class="modal-close btn-flat pink darken-1 white-text">
                <i class="material-icons right">close</i>Закрыть
            </a>
            <button class="btn waves-effect waves-light deep-orange darken-2" @click.prevent="sendUpdateProduct">
                <i class="material-icons right">send</i> Редактровать
            </button>
        </div>
    </div>
    </form>
</template>

<script>
import {mapActions, mapGetters} from "vuex";

    export default {
        name: "ModalEditProduct",
        props: {
            product_data: {},
        },
        data() {
            return {
                categoryEdit: {},
                modalInstanceEditProduct: null,
                fileStore: [],
            }
        },
        watch: {
            /*fileStore() {
                this.product_data.gallery_img  = this.fileStore.filter((file) => file !== "undefined")
            },*/
           /* product_data() {
                this.fileStore =  this.product_data.gallery_images
            }*/
        },
        methods: {
            ...mapActions([
                'loadProductsForAdmin',
                'productCreateAdmin',
                'productDeleteAdmin',
                'loadProducts',
                'productUpdateAdmin',
            ]),

            attachImageEditProduct() {
                //ложим файл изображения
                this.product_data.image = this.$refs.editProductImage.files[0];

                //чтение и загрузка файла в ДОМ элемент src
                let reader = new FileReader();
                reader.readAsDataURL(this.product_data.image)
                reader.addEventListener('load',  () => {
                    this.$refs.editProductImageDisplay.src = reader.result;
                });
            },


            attachImageEditProductGallery(){

                let files = this.$refs.editProductImageGallery.files

                let parentContainer = document.querySelector('.gallery_container-edit')
                let container = parentContainer.querySelectorAll('.empty_container-edit')

                //если количество файлов > количества контейнеров добавляем еще контейнеры
                if(container.length < files.length){

                    for (let index = 0; index < files.length - container.length; index++){

                        let el = document.createElement('div')
                        el.classList.add('vg-dotted-square', 'vg-center', 'empty_container-edit', 'newImage')
                        parentContainer.append(el)
                    }
                    container = parentContainer.querySelectorAll('.empty_container-edit')
                }


                for (let i in files) {
                    if (files.hasOwnProperty(i)){

                        let addElemId = this.fileStore.push(files[i]) - 1

                        this.showImageGalleryForEdit(files[i], container[i])

                        this.deleteDisplayImageForEdit(addElemId, container[i])
                    }
                }
            },

            //показвть изображения галлереи
            showImageGalleryForEdit(file, container) {
                let reader = new FileReader()

                //содержимое контейнера удаляем
                container.innerHTML = ''

                reader.readAsDataURL(file);

                reader.onload = function(e) {

                    //внутри контейнера создаем тег img
                    container.innerHTML = '<img class="img_item" style="width: 70px" src="">'

                    //вставляем в img файл
                    container.querySelector('img').setAttribute('src', reader.result)

                    container.classList.remove('empty_container-edit')
                };

            },

            //удалить изображение по клику
            deleteDisplayImageForEdit(addElemId, container){

                container.addEventListener('click',  () => {

                    //сносим контаинер
                    container.remove()

                    //и файл из переменной
                    delete this.fileStore[addElemId]

                    this.$refs.editProductImageGallery2.value = ''
                })
            },

            //удалить старое изображение по клику
            deleteDisplayImageForEditOld(elemId, container=false){

                this.product_data.gallery_images.splice(elemId, 1)
            },

            sendUpdateProduct() {
                //сливаем два массива с файлами старые файлы и новые
                let gall_files = this.product_data.gallery_images.map((item) => { return item.id})
                let filesAll = gall_files.concat(this.fileStore.filter(item => item !== "undefined"))

                let formData = new FormData();
                formData.append('id', this.product_data.id)
                formData.append('name', this.product_data.name)
                formData.append('code', this.product_data.code)
                formData.append('description', this.product_data.description)
                formData.append('category_id', this.product_data.category_id)
                formData.append('price', this.product_data.price)
                formData.append('count', this.product_data.count)
                formData.append('image', this.product_data.image)
                formData.append('_method', 'PUT')

                if (filesAll.length) {

                    filesAll.forEach((file, index) => {
                        formData.append(`${'gallery_img'}[${index}]`, file)
                    })
                } else {
                    formData.append('gallery_img', '')
                }


                this.productUpdateAdmin(formData)
                    .then(resp => {
                        if (resp.status === 200) {
                            this.$toasted.show('Продукт успешно отредактирован!',{
                                type: 'success',
                            })
                            this.modalInstanceEditProduct.close()

                            //очистка всего
                            this.fileStore = []
                            let containerOld = document.querySelectorAll('.newImage')

                            for (let i in containerOld){
                                if(containerOld.hasOwnProperty(i))
                                    containerOld[i].remove()
                            }

                            this.$refs.editProductImageGallery2.value = ''
                            this.$refs.editProductImageGallery2.classList.remove('valid')
                        }
                    })
            }

        },
        computed: {
            ...mapGetters([
                'getErrorsEditProduct',
                'getCategoriesAll'
            ]),

            child_categories() {
                let cat = this.getCategoriesAll.filter((item) => {
                    return Number(item.parent_id) !== 0
                })
                return cat
            }

        },
        mounted() {
            this.modalInstanceEditProduct = window.M.Modal.init(this.$refs.modal4);

            setTimeout(()=>{
                M.FormSelect.init(this.$refs.selectProd);
                window.M.updateTextFields()
            },1000)
        }
    }
</script>

<style scoped>
    .modal {
        max-height: 85% !important;
    }
    .modal.modal-fixed-footer {
        height: 85% !important;
    }

</style>
