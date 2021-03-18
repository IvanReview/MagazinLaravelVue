<template>
    <form @submit.prevent="sendUpdateUser">
        <div id="modal1" class="modal modal-fixed-footer" ref="modal1">
            <div class="modal-content">
                <h4>Данные пользователя</h4>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">face</i>
                        <label for="name">Имя</label>
                        <input name="first-name" type="text"
                               placeholder="Введите Имя.."
                               class="input-text"
                               id="name" required=""
                               v-model="user_data.name"
                        >
                        <!--<span class="helper-text invalid"
                              v-if="getErrorsEditProduct.name"
                        >
                            {{ getErrorsEditProduct.name[0] }}
                        </span>-->
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">insert_emoticon</i>
                        <label for="name">Фамилия</label>
                        <input name="first-name" type="text"
                               placeholder="Введите Фамилию.."
                               class="input-text"
                               id="surname" required=""
                               v-model="user_data.surname"
                        >
                        <!--<span class="helper-text invalid"
                              v-if="getErrorsEditProduct.name"
                        >
                            {{ getErrorsEditProduct.name[0] }}
                        </span>-->
                    </div>
                </div>

                <div class="row" >
                    <div class="input-field col s12">
                        <i class="material-icons prefix">fingerprint</i>
                        <label class="active">Выберите роль пользователя</label>
                        <select v-model="user_data.role" class="browser-default1"
                                ref="selectUserRole">

                            <option value="" disabled selected>Выберите роль пользователя</option>
                            <option v-for="role in users_role"
                                    :value="role.name "
                                    :key="role.id"
                            >{{ role.name }}
                            </option>
                        </select>

                       <!-- <span class="helper-text invalid"
                              v-if="getErrorsEditProduct.category_id"
                        >
                                {{ getErrorsEditProduct.category_id[0] }}
                            </span>-->
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">email</i>
                        <label for="code">Email</label>
                        <input name="first-name" type="text"
                               placeholder="Введите Email.."
                               class="input-text"
                               id="code" required=""
                               v-model="user_data.email"
                        >
                        <!--<span class="helper-text invalid"
                              v-if="getErrorsEditProduct.code"
                        >
                                {{ getErrorsEditProduct.code[0] }}
                        </span>-->
                    </div>
                </div>


                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">phone</i>
                        <label for="code">Телефон</label>
                        <input name="first-name" type="text"
                               placeholder="Введите Цену.."
                               class="input-text"
                               id="price" required=""
                               v-model="user_data.phone"
                        >
                        <!--<span class="helper-text invalid"
                              v-if="getErrorsEditProduct.price"
                        >
                            {{ getErrorsEditProduct.price[0] }}
                        </span>-->
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">edit</i>
                        <input
                            id="password3"
                            type="password"
                            class="validate"
                            v-model="user_data.password"
                        >
                        <label for="password3">Новый пароль</label>
                        <!--<small class="helper-text invalid" v-if="errors.password">
                            {{errors.password[0]}}
                        </small>-->
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">done</i>
                        <input
                            id="password-confirm"
                            type="password"
                            class="validate"
                            v-model="user_data.password_confirmation"
                        >
                        <label for="password-confirm">Подтвердите Пароль</label>
                     <!--   <small class="helper-text invalid" v-if="errors.password_confirmation">
                            Password Confirm
                        </small>-->
                    </div>
                </div>


                <div class="row">
                    <div class="col s12">
                        <label><strong>Выберите аватар:</strong></label>
                        <div v-if="user_data.image" class="user__img">
                            <img :src="`/storage/${user_data.image}`" ref="editUserImageDisplay"/>
                        </div>


                        <div class="file-field input-field ">
                            <div class="btn">
                                <span>File</span>
                                <input type="file"
                                       ref="editUserImage"
                                       v-on:change="attachImageEditUser"
                                >
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate"
                                       type="text"
                                       value=""
                                       ref="editUserImage2"
                                >
                            </div>
                            <!--<span class="helper-text invalid" v-if="getErrorsEditProduct.image">
                                {{ getErrorsEditProduct.image[0] }}
                            </span>-->
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <a href="" @click.prevent="" class="modal-close btn-flat pink darken-1 white-text">
                    <i class="material-icons right">close</i>Закрыть
                </a>
                <button class="btn waves-effect waves-light deep-orange darken-2" type="submit">
                    <i class="material-icons right">send</i> Редактровать
                </button>
            </div>
        </div>
    </form>
</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
    name: "ModalUserEdit",
    props: {
        user_data: {},
        user_index: ''
    },
    data: ()=>({
        users: {},
        loader: true,
        users_role: [
            { id:1, name: "user"},
            { id:2, name: "admin"},
        ],

        modalInstanceEditUser: {}

    }),
    methods: {
        ...mapActions([
            'updateUser',
        ]),

        sendUpdateUser() {
            let formData = new FormData();
            formData.append('id', this.user_data.id)
            formData.append('name', this.user_data.name)
            formData.append('surname', this.user_data.surname)
            formData.append('email', this.user_data.email)
            formData.append('phone', this.user_data.phone)
            formData.append('role', this.user_data.role)
            formData.append('image', this.user_data.image)
            formData.append('_method', 'PUT')
            if (this.user_data.password && this.user_data.password_confirmation) {
                formData.append('password', this.user_data.password)
                formData.append('password_confirmation', this.user_data.password_confirmation)
            }

            this.updateUser({formData,  userIndex: this.user_index}).then((resp) => {
                this.$toasted.show('Пользователь успешно отредактирован!')
                this.modalInstanceEditUser.close()
            })

        },

        attachImageEditUser() {
            //ложим файл изображения
            this.user_data.image = this.$refs.editUserImage.files[0];

            //чтение и загрузка файла в ДОМ элемент src
            let reader = new FileReader();
            reader.readAsDataURL(this.user_data.image)
            reader.addEventListener('load',  () => {
                this.$refs.editUserImageDisplay.src = reader.result;
            });

        },
    },
    computed: {
        ...mapGetters([

        ]),

    },
    mounted() {
        this.modalInstanceEditUser = window.M.Modal.init(this.$refs.modal1);

        setTimeout(()=>{
            M.FormSelect.init(this.$refs.selectUserRole);
            window.M.updateTextFields()
        },1000)
    }
}
</script>

<style scoped>
    .user__img img{
        width: 65px;
        height: 65px;
        border-radius: 50%;
        display: block;

    }

</style>
