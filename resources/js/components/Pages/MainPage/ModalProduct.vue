<template>

    <div :id="'modal3' + product_data.id" class="modal">
        <div class="modal-content">
            <!--<h5 class="center-align">sss</h5>-->
            <div class="modal-product ">
                <div class="container">
                    <div class="row">
                        <div class="col s12 m5">
                            <div class="modal-product__img">
                                <img :src="product_data.image ? `/storage/${product_data.image}` : `/storage/no_photo.jpg`" alt="Product">
                            </div>
                        </div>
                        <div class="col s12 m7">
                            <div class="product-info">
                                <h5>{{product_data.name}}</h5>
                                <hr>
                                <div class="product_price">Цена: {{product_data.price |currencyFilter}}</div>
                                <hr>
                                <div class="product-details">
                                    <router-link :to="{name: 'OneProduct', params: { id: product_data.id}}" class="btn">
                                        Посмотреть детали
                                    </router-link>
                                </div>
                                <div class="product-description">
                                    <h4>Описание</h4>
                                    <p>{{product_data.description}}</p>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
        </div>
    </div>
</template>

<script>
export default {
    name: "ModalProduct",
    props: {
        product_data: {}
    }

}
</script>

<style scoped>
    .modal-product__img img{
        width: 250px;
    }

    .product-details{
        padding: 40px 0;
        text-decoration: underline;
    }

</style>
