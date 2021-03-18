<template>
    <section class="contact-us">
        <h3 class="contact-us__title">Наши контакты </h3>

        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d6582.424017446588!2d48.393306435956184!3d54.31746803716114!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sru!2sru!4v1603020009685!5m2!1sru!2sru" width="100%" height="600" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0">
            </iframe>
        </div>


        <div class="contact-content">
            <div class="container">
                <div class="row">
                    <div class="col s12 l4">
                        <div class="card">
                            <div class="card-image">
                                <div class="card-image__wrapp">
                                    <i class="material-icons">email</i>
                                </div>
                            </div>
                            <div class="card-content">
                                <span class="card-title">Напишите нам</span>
                                <p class="card-text">Business standards services compliant. Users without extensible costs.</p>
                                <p class="card-bottom">hello@quato-shop.com</p>
                            </div>
                        </div>
                    </div>

                    <div class="col s12 l4">
                        <div class="card">
                            <div class="card-image">
                                <div class="card-image__wrapp">
                                    <i class="material-icons">contact_mail</i>
                                </div>
                            </div>
                            <div class="card-content">
                                <span class="card-title">Комерчиские услуги</span>
                                <p class="card-text">Business standards services compliant. Users without extensible costs.</p>
                                <p class="card-bottom">commercial@quato-shop.com</p>
                            </div>
                        </div>
                    </div>

                    <div class="col s12 l4">
                        <div class="card">
                            <div class="card-image">
                                <div class="card-image__wrapp">
                                    <i class="material-icons">map</i>
                                </div>
                            </div>
                            <div class="card-content">
                                <span class="card-title">Посетите наш оффис</span>
                                <p>262 Milacina Mrest Street, Behansed, Paris, France</p>
                                <p>8(927) 6 888 888</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="contact-form">
                        <h3 class="contact-form__title">Оставьте сообщение</h3>

                        <div class="row">
                            <form class="col s12">
                                <div class="row">
                                    <div class="input-field col s12 l4">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input id="icon_prefix" type="text" class="validate">
                                        <label for="icon_prefix">Имя</label>
                                        <span class="helper-text" data-error="wrong" data-success="right">Введите Имя</span>
                                    </div>
                                    <div class="input-field col s12 l4">
                                        <i class="material-icons prefix">phone</i>
                                        <input id="icon_telephone" type="tel" class="validate">
                                        <label for="icon_telephone">Телефон</label>
                                        <span class="helper-text" data-error="wrong" data-success="right">Введите Телефон</span>
                                    </div>

                                    <div class="input-field col s12 l4">
                                        <i class="material-icons prefix">email</i>
                                        <input id="email" type="email" class="validate">
                                        <label for="email">Email</label>
                                        <span class="helper-text" data-error="wrong" data-success="right">Введите email</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">mode_edit</i>
                                        <textarea id="textarea2" class="materialize-textarea" data-length="120"></textarea>
                                        <label for="textarea2">Ваше сообщение</label>
                                        <span class="helper-text" data-error="wrong" data-success="right">Введите сообщение</span>
                                    </div>
                                </div>

                                <div class="submit-button">
                                    <button class="btn waves-effect waves-light" type="submit" name="action">отпрваить
                                        <i class="material-icons right">send</i>
                                    </button>
                                </div>

                            </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>

</template>

<script>
export default {
    name: "ContactUs"
}
</script>

<style scoped>
    .contact-us__title {
        text-align: center;
        margin-bottom: 60px;
        font-weight: 700;
        font-size: 35px;
        text-transform: uppercase;
        position: relative;
    }
    .contact-us__title:before{
        content: "";
        background: #d6a279;
        display: block;
        width: 100px;
        height: 2px;
        position: absolute;
        left: 50%;
        margin-left: -25px;
        bottom: -15px;
    }


</style>
