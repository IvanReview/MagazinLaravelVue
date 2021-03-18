<template>
    <div id="modal1" class="modal modal-fixed-footer" ref="modal">
        <div class="modal-content">
            <h5>Данные заказа</h5>
            <hr>
            <form @submit.prevent="executeOrder">
                <div class="panel">
                    <h4>Заказ №{{ order.id }}</h4>
                    <p><b>Имя:</b> {{ order.name }}</p>
                    <p><b>Фамилия:</b> {{ order.surname }}</p>
                    <p><b>Номер телефона:</b> {{ order.phone }}</p>
                    <p><b>Email:</b> {{ order.email }}</p>
                    <p><b>Адрес:</b> {{ order.address }}</p>

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th>Изображение</th>
                            <th>Кол-во</th>
                            <th>Цена</th>
                            <th>Общая стоимость</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(product, index) in productsInOrder" :key="index">
                            <td>
                                <router-link to="/product">
                                    {{ product.name }}
                                </router-link>
                            </td>
                            <td><img height="56px" :src="`/storage/${product.image}`"></td>
                            <td><span class="badge">{{ product.pivot.quantity }}</span></td>
                            <td> {{ product.price | currencyFilter }}</td>
                            <td> {{ product.pivot.quantity * product.price | currencyFilter }}</td>
                        </tr>
                        <tr>
                            <td colspan="4"><b>Общая сумма:</b></td>
                            <td><strong> {{ total_sum | currencyFilter }}</strong></td>
                        </tr>
                        </tbody>
                    </table>
                    <br>
                </div>

            </form>
        </div>
        <div class="modal-footer">
            <a href="" @click.prevent="" class="modal-close btn-flat pink darken-1 white-text">
                <i class="material-icons right">close</i>Закрыть
            </a>
        </div>
    </div>
</template>

<script>
export default {
    name: "ModalViewOrder",
    props: {
        order: {},
        productsInOrder: {},
        total_sum: 0,
    },
}
</script>

<style scoped>

</style>
