import * as paginate from "../helpers/paginate";

let cart = window.localStorage.getItem('cart');

export default {
    state: {
        cart: cart ? JSON.parse(cart) : [],
        sum: 0,
        errorConfirmOrder: [],

    },
    actions: {

        addProductsToCart({commit, state}, product) {

            //добавление поля количество к объекту
            let productNewView = Object.assign({}, product, {quantity: 1})

            //находим индекс товара в корзине если число товара на складе = чис в заказе то больше тов. заказать нельзя
            let index = state.cart.findIndex(item => item.id === product.id)

            if(state.cart[index]){
                if (state.cart[index].quantity === product.count) {
                    return true
                } else {
                    commit('set_products_to_cart', productNewView)
                    return false
                }
            } else {
                commit('set_products_to_cart', productNewView)
                return false
            }
        },

        //увеличение кол-а товара
        incrementCart({commit}, index){
            commit('increment', index)
        },
        //уменьшение кол-а товара
        decrementCart({commit}, index){
            commit('decrement', index)
        },

        //удаление товара из корзины
        deleteProductCart({commit}, index){
            commit('remove_product_from_cart', index)
        },

        //отправка формы с заказом
        orderSend({commit, state}, orderData ) {
            return axios({
                method: 'POST',
                url: `/api/order`,
                data: orderData,
                headers: {
                    /*'Content-Type': 'multipart/form-data'*/
                }})
                .then((response) => {
                    commit('clearCart')
                    commit('set_errors_order',[])
                    return response
                })
                .catch((error) => {
                    switch (error.response.status) {
                        case 422:
                            commit('set_errors_order', error.response.data.errors)
                            return error.response.status
                            break;
                        case 500:
                            commit('set_errors_order', error.response.data)
                            return error.response.status
                            break;
                        default:
                            console.log(error)
                            break;
                    }
                })

        },


        //общая сумма товаров
        totalSumInCart({commit, state}){
            let sum = 0
            state.cart.forEach(item => {
                sum += item.price *item.quantity
            })
            return sum
        },

    },
    mutations: {

        //добавление товаров в корзину
        set_products_to_cart(state, product) {

            //ищем совпадение в корзине, если есть доб. ++, если нет добавл продукт
            const prodInCart = state.cart.find(item => item.id === product.id)
            if(prodInCart) {
                prodInCart.quantity++
            } else {
                state.cart.push(product)
            }
            //на последок сохран в сторедж
            this.commit('saveCartInStorage')
        },

        remove_product_from_cart(state, index) {
            state.cart.splice(index, 1)
            this.commit('saveCartInStorage')
        },

        increment(state, index) {
            state.cart[index].quantity++
            this.commit('saveCartInStorage')
        },

        decrement(state, index) {
            if (state.cart[index].quantity > 1)
                state.cart[index].quantity--
            this.commit('saveCartInStorage')
        },


        saveCartInStorage(state) {
            window.localStorage.setItem('cart', JSON.stringify(state.cart));
        },

        clearCart(state){
            state.cart = []
        },

        set_errors_order(state, errors) {
            state.errorConfirmOrder = errors
        },

        set_sum(state, cost){
            state.sum = cost
        },

    },
    getters: {
        getProductsInCart(state) {
            return state.cart
        },

        getFullSum(state) {
            return state.sum
        },

        getOrderConfirmErrors (state) {
            return state.errorConfirmOrder
        },

    }
}
