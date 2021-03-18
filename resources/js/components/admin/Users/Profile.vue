<template>
    <div class="user-profile">
        <div class="page-title">
            <h3>Профиль </h3>
        </div>

       <!-- <form class="col s12">
            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">mood</i>
                    <input placeholder="Введите имя"
                           id="first_name"
                           type="text"
                           class="validate"
                           v-model="user.name"
                    >
                    <label for="first_name">Имя</label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">face</i>
                    <input id="last_name" type="text" class="validate" v-model="user.surname">
                    <label for="last_name">Логин</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">email</i>
                    <input id="email" type="email" class="validate" v-model="user.email">
                    <label for="email">Email</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">extension</i>
                    <input id="password" type="password" class="validate">
                    <label for="password">Пароль</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">phone</i>
                    <input id="icon_telephone" type="tel" class="validate">
                    <label for="icon_telephone">Телефон</label>
                </div>
            </div>
        </form>-->

        <form @submit.prevent="sendUpdateUser">

            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">face</i>
                    <label for="name">Имя</label>
                    <input name="first-name" type="text"
                           placeholder="Введите Имя.."
                           class="input-text"
                           id="name"
                           v-model="user.name"
                    >
                    <span class="helper-text invalid"
                          v-if="getUserErrors.name"
                    >
                        {{ getUserErrors.name[0] }}
                    </span>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">insert_emoticon</i>
                    <label for="name">Фамилия</label>
                    <input name="first-name" type="text"
                           placeholder="Введите Фамилию.."
                           class="input-text"
                           id="surname"
                           v-model="user.surname"
                    >
                    <span class="helper-text invalid"
                          v-if="getUserErrors.surname"
                    >
                        {{ getUserErrors.surname[0] }}
                    </span>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">email</i>
                    <label for="code">Email</label>
                    <input name="first-name" type="text"
                           placeholder="Введите Email.."
                           class="input-text"
                           id="code"
                           v-model="user.email"
                    >
                    <span class="helper-text invalid"
                          v-if="getUserErrors.email"
                    >
                        {{ getUserErrors.email[0] }}
                    </span>
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
                           v-model="user.phone"
                    >
                    <span class="helper-text invalid"
                          v-if="getUserErrors.phone"
                    >
                        {{ getUserErrors.phone[0] }}
                    </span>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">edit</i>
                    <input
                        id="password3"
                        type="password"
                        class="validate"
                        v-model="user.password"
                    >
                    <label for="password3">Новый пароль</label>
                    <small class="helper-text invalid" v-if="getUserErrors.password">
                        {{getUserErrors.password[0]}}
                    </small>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">done</i>
                    <input
                        id="password-confirm"
                        type="password"
                        class="validate"
                        v-model="user.password_confirmation"
                    >
                    <label for="password-confirm">Подтвердите Пароль</label>
                </div>
            </div>


            <div class="row">
                <div class="col s12">
                    <label><strong>Выберите аватар:</strong></label>
                    <div v-if="user.image" class="user__img">
                        <img :src="`/storage/${user.image}`" ref="editUserImageDisplay"/>
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
                        <span class="helper-text invalid" v-if="getUserErrors.image">
                            {{ getUserErrors.image[0] }}
                        </span>
                    </div>
                </div>
            </div>


            <div class="modal-footer">
                <button class="btn waves-effect waves-light deep-orange darken-2" type="submit">
                    <i class="material-icons right">send</i> Редактровать
                </button>
            </div>
        </form>

        <!--<form class="form"  @submit.prevent="">
            <div class="input-field">
                <input
                    id="description"
                    type="text"
                    v-model="name"
                    :class="{invalid:  false }"
                >
                <label for="description" :class="{active: name.length }">Имя </label>
                <small
                    class="helper-text invalid"
                    v-if="true"
                >   Ведите имя
                </small>
            </div>



            <div class="switch">
                <label>
                    English
                    <input type="checkbox" v-model="isRuLocale" id="switch">
                    <span class="lever"></span>
                    Русский
                </label>
            </div>


            <button class="btn waves-effect waves-light" type="submit">
                Обновить
                <i class="material-icons right">send</i>
            </button>
        </form>-->
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
    import axios from "axios";
    import * as auth from "../../../helpers/http_service";

    export default {
        name: "Profile",
        data: ()=>({
            user: [],
            isRuLocale: false

        }),
        computed: {
            ...mapGetters([
                'getProfile',
                'getUserErrors'
            ]),

        },
        methods: {
            ...mapActions([
                'updateAdminProfile',
            ]),

            attachImageEditUser() {
                //ложим файл изображения
                this.user.image = this.$refs.editUserImage.files[0];

                //чтение и загрузка файла в ДОМ элемент src
                let reader = new FileReader();
                reader.readAsDataURL(this.user.image)
                reader.addEventListener('load',  () => {
                    this.$refs.editUserImageDisplay.src = reader.result;
                });
            },

            sendUpdateUser() {
                let formData = new FormData();
                formData.append('id', this.user.id)
                formData.append('name', this.user.name)
                formData.append('email', this.user.email)
                formData.append('role', this.user.role)
                formData.append('image', this.user.image)
                formData.append('_method', 'PUT')
                if (this.user.phone ) {
                    formData.append('phone', this.user.phone)
                }
                if (this.user.surname){
                    formData.append('surname', this.user.surname)
                }
                if (this.user.password || this.user.password_confirmation) {
                    formData.append('password', this.user.password)
                    formData.append('password_confirmation', this.user.password_confirmation)
                }

                this.updateAdminProfile(formData).then((resp) => {
                    if (resp.status === 200) {
                        this.$toasted.show('Профиль администратора успешно отредактирован!')
                    }
                })

            },
        },

        mounted() {

            this.user = this.getProfile

            setTimeout(()=>{
                window.M.updateTextFields()
            },0)
        }
    }
</script>

<style scoped>
    .user-profile{
        padding: 0 30px;
    }
    .switch {
        margin-bottom: 30px;
    }
    .user__img img{
        width: 100px;

    }
    .invalid {
        color: red;
    }

</style>
