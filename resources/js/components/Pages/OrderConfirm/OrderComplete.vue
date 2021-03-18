<template>
    <section class="order-complete">
        <div class="container">
            <div class="row">

                <div class="shop-step">
                    <div class="col s12 m4 l4">
                        <div class="step checked">
                            <div class="count ">01</div>
                            <span class="label">Козина</span>
                        </div>
                    </div>

                    <div class="col s12 m4 l4">
                        <div class="step checked ">
                            <span class="count">02</span>
                            <span class="label">Подтверждение заказа</span>
                        </div>

                    </div>

                    <div class="col s12 m4 l4">
                        <div class="step checked">
                            <span class="count">03</span>
                            <span class="label">Заказ Сделан</span>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="order-complete__finish center-align">
                    <div class="icon-bg">
                        <img src="img/icon-complete.png" alt="">
                    </div>
                    <p class="thank">Заказ успешно принят в обработку! мы с вами свяжемся</p>
                    <div class="buttons">
                        <router-link to="/" class="home btn" exact>
                            <span> <i class="material-icons left">arrow_back</i> на главную</span>
                        </router-link>
                    </div>
                </div>

            </div>

        </div>

    </section>

</template>

<script>
export default {
    name: "OrderComplete"
}
</script>

<style scoped>

</style>
