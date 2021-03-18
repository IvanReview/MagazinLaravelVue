<template>
    <section class="login">
        <div class="grey darken-1 empty-layout">
            <form class="card auth-card" @submit.prevent="resetPasswordRequest">
                <div class="card-content">
                    <span class="card-title">Восстановление пароля</span>
                    <p>Ведите Email и мы пришлем вам ссылку для сброса пароля.</p>
                    <div class="input-field">
                        <input id="email1" type="text" class="validate" v-model="user.email">
                        <label for="email1">Email</label>
                        <small class="helper-text invalid"
                               v-if="errors.email"
                        >
                            {{errors.email[0]}}
                        </small>
                    </div>

                    <div style="display: flex; justify-content: space-between">
                        <p class="forget-pass">
                            <router-link class="purple-text darken-4" to="/login">Вернуться на страницу логина</router-link>
                        </p>
                    </div>
                </div>
                <div class="card-action">
                    <div>
                        <button
                            class="btn waves-effect waves-light auth-submit  purple darken-4"
                            type="submit"
                            ref="btnSubmit"
                        >
                            Запросить пароль
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                    <p class="center">
                        Нет аккаунта?
                        <router-link to="/register">Зарегистрироваться</router-link>
                    </p>

                </div>
            </form>
        </div>
    </section>
</template>

<script>
import * as buttons from '../../helpers/load_buttons'
export default {
    name: "ResetPasswordRequest",
    data: () => ({
        user: {
            email: '',
        },
        errors: {},
        btnOldHtml: ''
    }),
    methods: {
        resetPasswordRequest() {
            buttons.disableSubmission(this.$refs.btnSubmit)

            axios.post(`/api/auth/reset-password-request`, this.user)
                .then((response) => {
                    this.$toasted.show(response.data.message,{
                        type: 'success',
                    })

                    buttons.enableSubmission(this.$refs.btnSubmit)
                    this.$router.push({name: 'ResetPassword', params: {email: this.user.email}})
                })
                .catch((error) => {
                    switch (error.response.status) {
                        case 422:
                            this.errors = error.response.data.errors;
                            buttons.enableSubmission(this.$refs.btnSubmit)
                            break;
                        case 500:
                            this.$toasted.show(error.response.data.message,{
                                type: 'error',
                            })
                            buttons.enableSubmission(this.$refs.btnSubmit)
                            break;
                        default:

                            break;
                    }
                })
        },
    }
}
</script>

<style scoped>
    .invalid {
        color: red;
    }

</style>
