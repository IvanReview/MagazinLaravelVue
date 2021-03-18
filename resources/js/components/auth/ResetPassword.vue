<template>
    <section class="resetPassword">
        <div class="grey darken-1 empty-layout col s12">
            <form class="card auth-card" @submit.prevent="resetPassword">
                <div class="card-content">
                    <span class="card-title">Сброс пароля</span>
                    <div class="input-field">
                        <input
                            id="name"
                            type="text"
                            class="validate"
                            v-model="user.email"
                        >
                        <label for="name">Email</label>
                        <small class="helper-text invalid" v-if="errors.email">{{errors.email[0]}}</small>
                    </div>
                    <div class="input-field">
                        <input
                            id="email"
                            type="text"
                            v-model="user.verification_code"
                        >
                        <label for="email">Код верификации</label>
                        <small class="helper-text invalid" v-if="errors.verification_code">{{errors.verification_code[0]}}</small>
                    </div>

                    <div class="row">
                        <div class="input-field col s6">
                            <input
                                id="password3"
                                type="password"
                                class="validate"
                                v-model="user.password"
                            >
                            <label for="password3">Новый Пароль</label>
                            <small class="helper-text invalid" v-if="errors.password">{{errors.password[0]}}</small>
                        </div>
                        <div class="input-field col s6">
                            <input
                                id="password-confirm"
                                type="password"
                                class="validate"
                                v-model="user.password_confirmation"
                            >
                            <label for="password-confirm">Подтвердите Пароль</label>
                            <small class="helper-text invalid" v-if="errors.password_confirmation">Password Confirm</small>
                        </div>
                    </div>

                    <p>
                        <label class="back-login">
                            <router-link to="/login">Вернуться на страницу аутоинтефикации</router-link>
                        </label>
                    </p>
                </div>
                <div class="card-action">
                    <div>
                        <button
                            class="btn waves-effect waves-light auth-submit purple darken-4"
                            type="submit"
                            ref="btnSubmit"
                        >
                            Сбросить пароль
                            <i class="material-icons right">send</i>
                        </button>
                    </div>

                    <p class="center">
                        <router-link to="/reset-password-request">Отправить код еще раз</router-link>
                    </p>
                </div>
            </form>

        </div>

    </section>
</template>

<script>
import * as buttons from '../../helpers/load_buttons'
export default {
name: "ResetPassword",
    data() {
        return {
            user: {
                email: '',
                verification_code: '',
                password: '',
                password_confirmation: ''
            },
            errors: {},
            btnOldHtml: ''

        }
    },
    beforeRouteEnter(to, from, next){
        next(vm => {
            vm.user.email = to.params.email
        })

    },
    methods: {
        resetPassword() {

            buttons.disableSubmission(this.$refs.btnSubmit)
            axios.post(`/api/auth/reset-password`, this.user)
                .then((response) => {

                    this.$toasted.show(response.data.message,{
                        type: 'success',
                    })

                    buttons.enableSubmission(this.$refs.btnSubmit)
                    this.$router.push('/login')
                })
                .catch((error) => {
                    switch (error.response.status) {
                        case 422:
                            this.errors = error.response.data.errors;
                            buttons.enableSubmission(this.$refs.btnSubmit)
                            break;
                        case 401:
                            this.errors = error.response.data.errors;
                            buttons.enableSubmission(this.$refs.btnSubmit)
                            break;
                        default:
                            /*this.$toasted.error({
                                message: 'Ошибка при  авторизации'
                            });*/
                            this.$toasted.show(error.response.data.message,{
                                type: 'error',
                            })
                            buttons.enableSubmission(this.$refs.btnSubmit)
                            break;
                    }
                })
        },
    },
    mounted() {

        setTimeout(()=>{
            window.M.updateTextFields()
        },200)
    }
}
</script>

<style scoped>
    .back-login a:hover{
        color: rebeccapurple;
        transition: all .5s ease;
    }
    .invalid {
        color: red;
    }

</style>
