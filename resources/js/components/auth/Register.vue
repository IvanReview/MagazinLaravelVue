<template>
    <section class="register">
        <div class="grey darken-1 empty-layout col s12">
            <form class="card auth-card" @submit.prevent="submitHandler">
                <div class="card-content">
                    <span class="card-title">Зарегистрироваться</span>
                    <div class="input-field">
                        <input
                            id="name"
                            type="text"
                            class="validate"
                            v-model="user.name"
                        >
                        <label for="name">Имя</label>
                        <small class="helper-text invalid" v-if="errors.name">{{errors.name[0]}}</small>
                    </div>
                    <div class="input-field">
                        <input
                            id="email"
                            type="text"
                            v-model="user.email"
                        >
                        <label for="email">Email</label>
                        <small class="helper-text invalid" v-if="errors.email">{{errors.email[0]}}</small>
                    </div>

                    <div class="row">
                        <div class="input-field col s6">
                            <input
                                id="password3"
                                type="password"
                                class="validate"
                                v-model="user.password"
                            >
                            <label for="password3">Пароль</label>
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
                        <label>
                            <input type="checkbox" v-model="user.confirm" />
                            <span>С правилами согласен</span>
                        </label>
                    </p>
                </div>
                <div class="card-action">
                    <div>
                        <button
                            class="btn waves-effect waves-light auth-submit"
                            type="submit"
                        >
                            Зарегистрироваться
                            <i class="material-icons right">send</i>
                        </button>
                    </div>

                    <p class="center">
                        Уже есть аккаунт?
                        <router-link to="/login">Войти!</router-link>
                    </p>
                </div>
            </form>

        </div>

    </section>

</template>



<script>

export default {
    name: "Register",
    data: ()=>({
        user: {
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            confirm: false
        },
        errors: {},

    }),
    methods: {
        submitHandler() {

            if (this.user.confirm) {
                axios.post('api/auth/register', this.user)
                    .then((response) => {
                        this.$router.push('/login')
                        this.$toasted.show(response.data.message,{
                            type: 'success',
                        });
                    })
                    .catch((error) => {
                        switch (error.response.status) {
                            case 422:
                                this.errors = error.response.data.errors;
                                break;
                            case 500:
                                this.$toasted.show(error.response.data.message, {
                                    type: 'error',
                                });
                            default:
                                this.$toasted.show('Ошибка при регистрации!',{
                                    type: 'error',
                                });
                                break;
                        }
                    })
            } else {
                this.$toasted.show("Согласитесь с правилами", {
                    type: 'error',
                });
            }

        }
    }

}
</script>

<style scoped>
    .helper-text.invalid{
        color:#f44336;
        text-align: left;
    }


</style>
