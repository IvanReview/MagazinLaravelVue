<template>
    <section class="login">
        <div class="grey darken-1 empty-layout">
            <form class="card auth-card" @submit.prevent="submitHandler">
                <div class="card-content">
                    <span class="card-title">Войти</span>
                    <div class="input-field">
                        <input id="email1" type="text" class="validate" v-model="user.email">
                        <label for="email1">Email</label>
                        <small class="helper-text invalid"
                               v-if="errors.email"
                        >
                            {{errors.email[0]}}
                        </small>
                    </div>
                    <div class="input-field">
                        <input
                            id="password"
                            type="password"
                            class="validate"
                            v-model="user.password"
                        >
                        <label for="password">Пароль</label>
                        <small class="helper-text invalid"
                               v-if="errors.password"
                        >
                            {{errors.password[0]}}
                        </small>
                    </div>
                    <div style="display: flex; justify-content: space-between">
                        <p>
                            <label>
                                <input type="checkbox" v-model="user.remember_me" />
                                <span>Запомнить меня</span>
                            </label>
                        </p>
                        <p class="forget-pass">
                            <router-link to="/reset-password-request">Забыли пароль?</router-link>
                        </p>
                    </div>
                </div>
                <div class="card-action">
                    <div>
                        <button
                            class="btn waves-effect waves-light auth-submit"
                            type="submit"
                        >
                            Войти
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
import * as auth from '../../helpers/http_service'

export default {
    name: "Login",
    data: () => ({
        user: {
            email: '',
            password: '',
            remember_me: false
        },
        errors: {},
    }),
    methods: {
        submitHandler() {
            axios.post('api/auth/login', this.user)
                .then((response) => {
                    if (response.status === 200){
                        //из хелпера
                        auth.setToken(response.data)
                        this.errors = {}

                        if (auth.getUserRole() === 'admin') {
                            this.$router.push('/admin')
                        } else {
                            this.$router.push('/person')
                        }
                        this.$toasted.show('Вы успешно вошли в профиль!',{
                            type: 'success',
                        });
                    }
                })
                .catch((error) => {
                    switch (error.response.status) {
                        case 422:
                            this.errors = error.response.data.errors;
                            break;
                        case 401: error.response.data.message
                            this.$toasted.show(error.response.data.message,{
                                type: 'error',
                            });
                            break;
                        case 500:
                            this.$toasted.show(error.response.data.message,{
                                type: 'error',
                            });
                            break;
                        default:

                            break;
                    }
                })
        }


    },
    mounted() {
        window.M.AutoInit();
        setTimeout(()=>{
            window.M.updateTextFields()
        },0)
    }
}
</script>

<style scoped>
    .helper-text.invalid{
        color:#f44336;
        text-align: left;
    }
    .forget-pass a{
        transition: all .3s ease;
    }
    .forget-pass a:hover{
        color: #ffab40;

    }



</style>
