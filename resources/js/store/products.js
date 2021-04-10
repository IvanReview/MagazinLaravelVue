import * as paginate from "../helpers/paginate";

export default {
    state: {
        products: [],      //продукты
        pagination: {},    //параметры пагинации
        paginationAdminProduct: {},
        filters: {
            page: '',
            sort_param: '',
            items_on_page: '',
            price_from: '',
            price_to: '',
            category_id: ''
        },

        productsAdmin: [], //продукты в админке

        errorsCreateProduct: [],
        errorsEditProduct: [],

    },
    actions: {
        //получение всех продуктов
        loadProducts({commit}, page_url) {
            page_url = page_url || '/api/products';

            return axios.get(page_url,)
                .then((response) => {
                    commit('set_products_to_state', response.data.data)

                    //параметры для пагинации makePagination в хелпере
                    const pagination = paginate.makePagination(response.data)
                    commit('set_paginate', pagination)

                    commit('reset_filters')
                    return response.data
                }).catch((error) => {
                    console.log(error)
                })
        },

        //Различного рода сортировка
        optionViewProducts({commit, state}, {page_url, itemsOnPage, sortParam, priceFrom, priceTo, categoryId}) {

            page_url = page_url || '/api/products';

            return axios.get(page_url, {
                params: {
                    sort_param:      sortParam      ||  state.filters.sort_param,
                    items_on_page:   itemsOnPage    ||  state.filters.items_on_page,
                    price_from:      priceFrom      ||  state.filters.price_from,
                    price_to:        priceTo        ||  state.filters.price_to,
                    category_id:     categoryId     ||  state.filters.category_id,

                }})
                .then((response) => {
                    commit('set_products_to_state', response.data.data)

                    if (itemsOnPage){//если задано число элементов на странице меняем стейт иначе берем предидущее знач
                        commit('set_items_on_page', itemsOnPage)
                    }
                    if (sortParam){//если заданны парам сортировки меняем стейт иначе берем предидущее знач
                        commit('set_product_sort_by_different_params', sortParam)
                    }
                    if (priceFrom){//если задан низ цены меняем стейт иначе берем предидущее знач
                        commit('set_sort_min_product_price', priceFrom)
                    }
                    if (priceTo){//если задана верх цены меняем стейт иначе берем предидущее знач
                        commit('set_sort_max_product_price', priceTo)
                    }
                    if (categoryId){//если задана верх цены меняем стейт иначе берем предидущее знач
                        commit('set_sort_by_category_products_to_state', categoryId)
                    }

                    //для пагинации makePagination в хелпере
                    const pagination = paginate.makePagination(response.data)
                    commit('set_paginate', pagination)

                    return response.data
                }).catch((error) => {
                    console.log(error)
                })
        },

        //Поиск продукта
        searchProductsInBd({commit}, value) {
            axios.get('/api/products', {
                params: {
                    search_pattern: value,
                }
            }).then((response) => {
                commit('set_product_by_search', response.data.data)

                const pagination = paginate.makePagination(response.data)
                commit('set_paginate', pagination)
            })
                .catch((error) => {
                    console.log(error)
                })
        },


        /*Для админки*/
        loadProductsForAdmin({commit}, page_url) {
            page_url = page_url || '/api/admin/products';

            return axios.get(page_url)
                .then((response) => {

                    commit('set_categories_all', response.data.categories)
                    commit('set_categories_tree', response.data.categories_tree)
                    commit('set_products_admin_to_state', response.data.products.data)

                    //параметры для пагинации makePagination в хелпере
                    const pagination = paginate.makePaginationForAdmin(response.data.products)
                
                    commit('set_paginate_for_admin_product', pagination)

                    /*commit('reset_filters')*/
                    return response.data
                }).catch((error) => {
                    console.log(error)
                })
        },

        //Создание продукта в админке
        productCreateAdmin({commit}, formData) {
            return axios({
                method: 'POST',
                url: '/api/admin/products',
                data: formData,
                headers: {
                    'Content-Type': 'multipart/form-data'
                }})
                .then((response) => {
                    if (response.status === 200){

                        commit('add_product_to_state', response.data)
                        commit('set_errors_create_product', [])
                        return response
                    }
                })
                .catch((error) => {
                    switch (error.response.status) {
                        case 422:
                            commit('set_errors_create_product', error.response.data.errors)
                            return error.response.status
                            break;
                        default:
                            console.log(error)
                            break;
                    }
                })

        },

        productUpdateAdmin({commit}, formData) {

            return  axios({
                method: 'POST',
                url: `/api/admin/products/${formData.get('id')}`,
                data: formData,
                headers: {
                    'Content-Type': 'multipart/form-data'
                }})
                .then((response) => {
                    if (response.status === 200){
                        commit('update_products_to_state', response.data)
                        commit('set_errors_edit_product', [])

                        return response
                    }
                })
                .catch((error) => {
                    switch (error.response.status) {
                        case 422:
                            commit('set_errors_edit_product', error.response.data.errors)
                            return error.response.status
                            break;
                        default:
                            console.log(error)
                            break;
                    }
                })
        },

        productDeleteAdmin({commit}, {productId, index}) {
            return axios({
                method: 'DELETE',
                url: `/api/admin/products/${productId}`,
            })
                .then((response) => {
                    if (response.status === 200){

                        commit('delete_products_to_state', index)
                        return response
                    }
                })
                .catch((error) => {
                    console.log(error)
                })

        },

    },
    mutations: {
        //манипуляции с продуктами
        set_products_to_state(state, products){
            state.products = products
        },

        set_products_admin_to_state(state, products){
            state.productsAdmin = products
        },

        add_product_to_state(state, product) {
            state.productsAdmin.unshift(product)
        },

        update_products_to_state(state, product) {
            let index = state.productsAdmin.findIndex(item => item.id == product.id)

            state.productsAdmin.splice(index, 1, product)
        },

        delete_products_to_state(state, index) {
            state.productsAdmin.splice(index, 1)
        },


        //мутации для фильтров
        set_sort_by_category_products_to_state(state, categoryId){
            state.filters.category_id = categoryId
        },
        set_items_on_page(state, data) {
            state.filters.items_on_page = data
        },
        set_product_sort_by_different_params(state, data) {
            state.filters.sort_param = data
        },

        set_sort_min_product_price(state, data) {
            state.filters.price_from = data
        },

        set_sort_max_product_price(state, data) {
            state.filters.price_to = data
        },

        set_product_by_search(state, product) {
            state.products = product
        },

        reset_filters(state){
            state.filters = {}
        },

        //Мутации для ошибок
        set_errors_create_product(state, data) {
            state.errorsCreateProduct = data
        },

        set_errors_edit_product(state, data) {
            state.errorsEditProduct = data
        },



        //Пагинация
        set_paginate(state, pagination){
            state.pagination = pagination
        },

        set_paginate_for_admin_product(state, pagination){
            state.paginationAdminProduct = pagination
        },


    },
    getters: {
        getProducts(state){
            return state.products
        },

        getProductsAdmin(state){
            return state.productsAdmin
        },

        getPagination(state){
            return state.pagination
        },

        getPaginationAdminProduct(state) {
            return state.paginationAdminProduct
        },

        getFilterParams(state){
            return state.filters
        },

        getErrorsCreateProduct(state) {
            return  state.errorsCreateProduct
        },

        getErrorsEditProduct(state) {
            return  state.errorsEditProduct
        }

    }

}
