<template>
    <form @submit.prevent="sendUpdateCategory(category_data)">
    <div id="modal2" class="modal modal-fixed-footer" ref="modal2">
        <div class="modal-content">
            <div class="row">
                <div class="modal-content">
                    <h4>Редактировать Категорию</h4>

                    <div class="row">
                        <div class="input-field col s12">
                            <label for="name">Имя Категории</label>
                            <input name="first-name" type="text"
                                   placeholder="Введите Имя.."
                                   class="input-text"
                                   id="name"
                                   value="category_data.name"
                                   v-model=" category_data.name"
                            >
                            <span class="helper-text invalid"
                                  v-if="getErrorsEditCategory.name"
                            >
                                {{getErrorsEditCategory.name[0]}}
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <label for="code">Код</label>
                            <input name="first-name" type="text"
                                   placeholder="Введите Имя.."
                                   class="input-text"
                                   id="code"
                                   v-model=" category_data.code"
                            >
                            <span class="helper-text invalid"
                                  v-if="getErrorsEditCategory.code"
                            >
                                {{getErrorsEditCategory.code[0]}}
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <textarea id="textarea1"
                                      class="materialize-textarea browser-default"
                                      v-model="category_data.description"
                                      placeholder="Введите описание.."
                            ></textarea>
                            <label for="textarea1">Описание</label>
                            <span class="helper-text invalid"
                                  v-if="getErrorsEditCategory.description"
                            >
                                {{getErrorsEditCategory.description[0]}}
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <label class="category__label" style="padding-left: 10px">Название Родительской Категории</label>
                        <div class="input-field col s12">
                            <!--<label class="category__label">Название Родительской Категории</label>-->
                            <select v-model="category_data.parent_id" class="browser-default" ref="selectCatEdit">
                                <option value="" disabled selected> Выберите родительскую категорию</option>
                                <option value="0">Без родителей(корневая категория)</option>
                                <option v-for="category in parent_categories"
                                        :value="category.id"
                                        :key="category.id"
                                >{{category.name}}
                                </option>
                            </select>


                            <span class="helper-text invalid"
                                  v-if="getErrorsEditCategory.parent_id"
                            >
                                {{getErrorsEditCategory.parent_id[0]}}
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s12">
                            <label><strong>Выберите изображение:</strong></label>
                            <div v-if="category_data.image" class="category__img">
                                <img :src="`/storage/${category_data.image}`"
                                     ref="editCatImageDisplay"
                                />
                            </div>


                            <div class="file-field input-field ">
                                <div class="btn">
                                    <span>File</span>
                                    <input type="file"
                                           ref="editCatImage"
                                           class=""
                                           v-on:change="attachImageEdit"
                                    >
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate"
                                           type="text"
                                           value=""
                                           ref="editCatImage2"
                                    >
                                </div>
                                <span class="helper-text invalid"
                                      v-if="getErrorsEditCategory.image"
                                >
                                {{getErrorsEditCategory.image[0]}}
                            </span>
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
            <button class="btn waves-effect waves-light light-blue darken-2"
                   type="submit"
            >
                <i class="material-icons right">send</i> Редактировать
            </button>
        </div>
    </div>
    </form>
</template>

<script>
import {mapActions, mapGetters} from "vuex";

    export default {
        name: "ModalEditCategory",
        props: {
            category_data: {}
        },
        data() {
            return {
                categoryEdit: {},

                moreExists: true,
                nextPage: 0
            }
        },
        methods: {
            ...mapActions([
                'categoryUpdateAdmin'
            ]),

            sendUpdateCategory() {
                let formData = new FormData();
                formData.append('id', this.category_data.id)
                formData.append('name', this.category_data.name)
                formData.append('code', this.category_data.code)
                formData.append('parent_id', this.category_data.parent_id)
                formData.append('description', this.category_data.description)
                formData.append('image', this.category_data.image)
                formData.append('_method', 'PUT')

                this.categoryUpdateAdmin(formData)
                    .then(resp => {
                        if (resp.status === 200) {
                            this.$toasted.show(`Категория успешно отредактированна!`,{
                                type: 'success',
                            })
                            this.modalInstance.close()
                        }
                    })

            },

            attachImageEdit() {
                this.category_data.image = this.$refs.editCatImage.files[0];

                let reader = new FileReader();
                reader.readAsDataURL(this.category_data.image)
                reader.addEventListener('load',  () => {
                    this.$refs.editCatImageDisplay.src = reader.result;
                });
            },

        },
        computed: {
            ...mapGetters([
                'getErrorsEditCategory',
                'getCategories'

            ]),
            parent_categories() {
                let cat = this.getCategories.filter((item) => {
                    return Number(item.parent_id) === 0
                })
                return cat
            }
        },
        mounted() {
            this.modalInstance = window.M.Modal.init(this.$refs.modal2);

            setTimeout(()=>{
                M.FormSelect.init(this.$refs.selectCatEdit);
                window.M.updateTextFields()
            },200)

        }
    }
</script>

<style scoped>

</style>
