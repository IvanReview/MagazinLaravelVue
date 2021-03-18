<template>
    <div id="modal1" class="modal modal-fixed-footer" ref="modalOrder">
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
              <button type="submit" class="btn-success btn"><span class="fa fa-check"></span>
                Перевести в выполнено
              </button>
            </div>

          </form>
        </div>
        <div class="modal-footer">
            <a href="" @click.prevent="" class="modal-close btn-flat pink darken-1 white-text">
                <i class="material-icons right">close</i>Закрыть
            </a>
            <!--<button class="btn waves-effect waves-light deep-purple darken-4" type="submit">
                <i class="material-icons right">send</i> Выполнено
            </button>-->
        </div>
    </div>
</template>

<script>
export default {
    name: "ModalLookOrder",
    props: {
      order: {},
      productsInOrder: {},
      total_sum: 0,

    },
    data() {
        return {
            modalInstanceOrder: null

        }
    },
    computed: {


    },
    methods: {
        executeOrder() {
            this.$emit('executeOrder', this.order)
        }
    },
    mounted() {
        this.modalInstanceOrder = window.M.Modal.init(this.$refs.modalOrder);

    }

}
</script>

<style scoped>
    .btn-success{
        margin-bottom: 40px;
    }

</style>
