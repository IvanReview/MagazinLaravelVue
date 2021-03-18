<template>
    <form @submit.prevent="categoryCreate">
        <div id="modal1" class="modal modal-fixed-footer" ref="modal1">
            <div class="row">
                <div class="modal-content">
                    <h4 class="category__create">Создать Категорию</h4>

                    <div class="row">
                        <div class="input-field col s12">
                            <label for="name">Имя Категории</label>
                            <input name="first-name" type="text"
                                   placeholder="Введите Имя.."
                                   class="input-text"
                                   id="name" required=""
                                   v-model="categoryCreate.name"
                            >
                            <span class="helper-text invalid"
                                  v-if="getErrorsCreateCategory.name"
                            >
                                {{getErrorsCreateCategory.name[0]}}
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <label for="code">Код</label>
                            <input name="first-name" type="text"
                                   placeholder="Введите Код.."
                                   class="input-text"
                                   id="code" required=""
                                   v-model="categoryCreate.code"
                            >
                            <span class="helper-text invalid"
                                  v-if="getErrorsCreateCategory.code"
                            >
                                {{getErrorsCreateCategory.code[0]}}
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                                <textarea id="textarea1"
                                          class="materialize-textarea browser-default"
                                          v-model="categoryCreate.description"
                                          placeholder="Введите описание.."
                                ></textarea>
                            <label for="textarea1">Описание</label>
                            <span class="helper-text invalid"
                                  v-if="getErrorsCreateCategory.description"
                            >
                                {{getErrorsCreateCategory.description[0]}}
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">

                            <select v-model="categoryCreate.parent_id" class="browser-default" ref="selectCat">
                                <option value="" disabled selected> Выберите родительскую категорию</option>
                                <option value="0">Без родителей(корневая категория)</option>
                                <option v-for="category in parent_categories"
                                        :value="category.id"
                                        :key="category.id"
                                >{{category.name}}
                                </option>
                            </select>
                           <!-- <label class="category__label">Название Родительской Категории</label>-->

                            <span class="helper-text invalid"
                                  v-if="getErrorsCreateCategory.parent_id"
                            >
                                {{getErrorsCreateCategory.parent_id[0]}}
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s12">
                            <label><strong>Выберите изображение:</strong></label>
                            <div v-if="categoryCreate.image" class="category__img">
                                <img src="" ref="newCatImageDisplay"/>
                            </div>


                            <div class="file-field input-field ">
                                <div class="btn">
                                    <span>File</span>
                                    <input type="file"
                                           ref="newCatImage"
                                           v-on:change="attachImage"
                                    >
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate"
                                           type="text"
                                           value=""
                                           ref="newCatImage2"
                                    >
                                </div>
                                <span class="helper-text invalid" v-if="getErrorsCreateCategory.image">
                                    {{getErrorsCreateCategory.image[0]}}
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <div class="modal-footer">
                <a href="" @click.prevent="" class="modal-close btn-flat pink darken-1 white-text">
                    <i class="material-icons right">close</i>Закрыть
                </a>
                <button class="btn waves-effect waves-light" @click.prevent="createCategory" type="submit">
                    <i class="material-icons right">send</i> Создать
                </button>
            </div>
        </div>
    </form>
</template>

<script>
import {mapActions, mapGetters} from "vuex";

    export default {
        name: "ModalCreateCategory",
        props: {
            categories_data: {}

        },
        data() {
            return {
                categoryCreate: {
                    name: '',
                    image: '',
                    code: '',
                    description: '',
                    parent_id: ''
                },
                modalInstance: null,
            }
        },
        methods: {
            ...mapActions([
                'loadCategories',
                'categoryCreateAdmin',

            ]),

            //Отображение изображения сразу после загрузки
            attachImage() {
                //ложим файл изображения
                this.categoryCreate.image = this.$refs.newCatImage.files[0];

                //чтение и загрузка файла в ДОМ элемент src
                let reader = new FileReader();
                reader.readAsDataURL(this.categoryCreate.image)

                reader.addEventListener('load',  () => {
                    this.$refs.newCatImageDisplay.src = reader.result;
                })


            },

            createCategory() {
                let formData = new FormData();

                formData.append('name', this.categoryCreate.name)
                formData.append('code', this.categoryCreate.code)
                formData.append('description', this.categoryCreate.description)
                formData.append('parent_id', this.categoryCreate.parent_id)
                formData.append('image', this.categoryCreate.image)

                this.categoryCreateAdmin(formData)
                    .then(resp => {
                        if (resp.status === 200) {
                            this.$toasted.show('Категория успешно созданна!',{
                               /* type: 'success',*/
                            })
                            this.categoryCreate = {
                                name: '',
                                image: '',
                                code: '',
                                description: '',
                            }
                            this.$refs.newCatImage2.value = ""
                            this.$refs.newCatImage2.classList.remove('valid')
                            this.modalInstance.close()
                        }
                    })
            }

        },
        computed: {
            ...mapGetters([
                'getErrorsCreateCategory',
                "getCategories",
            ]),

            parent_categories() {
                 let cat = this.getCategories.filter((item) => {
                    return Number(item.parent_id) === 0
                })
                return cat
            }
        },
        mounted() {

            this.modalInstance = window.M.Modal.init(this.$refs.modal1)


            setTimeout(()=>{
                M.FormSelect.init(this.$refs.selectCat);
                window.M.updateTextFields()
            },200)
        }
    }
</script>

<style scoped>
    .category__img img{
        width: 200px;
    }

    .input-field{
        margin-bottom: 0;
    }

    .input-field > label{
        font-size: 1.2rem;
    }
    .category__label{
        font-size: 20px;
    }

</style>
