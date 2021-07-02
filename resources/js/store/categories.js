export default {
    state: {
        categories: [],
        errorsCreate: [],
        errorsEdit: [],

        paginate: {
            nextPage: 2,
            moreExists: true,
        },

        categoriesAdministrate: [],

        categoriesAll: [],
        categoryTree: [],
    },

    actions: {
        loadCategories({commit}) {
            axios({
                method: 'GET',
                url: `/api/categories`,
            })
                .then((response) => {
                    commit('set_categories_to_state', response.data)
                })
                .catch((error) => {
                    console.log(error)
                })
        },

        loadCategoriesForAdmin({commit}) {
            return axios({
                method: 'GET',
                url: `/api/admin/categories`,
            })
                .then((response) => {
                    commit('set_categories_admin_to_state', response.data.data)
                    return response
                })
                .catch((error) => {
                    console.log(error)
                })
        },

        loadMoreCategories({commit, state}) {
            axios.get(`/api/admin/categories?page=${state.paginate.nextPage}`)
                .then((response) => {

                    if (response.data.current_page < response.data.last_page){
                        state.paginate.moreExists = true
                        state.paginate.nextPage = response.data.current_page + 1
                    } else {
                        state.paginate.moreExists = false
                    }
                    commit('add_load_categories', response.data.data)
                    return response
                })
                .catch((error) => {
                    console.log(error)
                })

        },


        //создать категорию
        categoryCreateAdmin({commit}, formData) {
            //файлы слать обязательно через FormData и заголовки добавлять

            return axios({
                method: 'POST',
                url: '/api/admin/categories',
                data: formData,
                headers: {
                    'Content-Type': 'multipart/form-data'
                }})
                .then((response) => {
                    if (response.status === 200){
                        commit('add_category_to_state', response.data)
                        commit('set_errors_create', [])

                        return response
                    }
                })
                .catch((error) => {
                    switch (error.response.status) {
                        case 422:
                            commit('set_errors_create', error.response.data.errors)
                            break;
                        default:
                            console.log(error)
                            break;
                    }
                })
        },

        //обновить категорию
        categoryUpdateAdmin({commit}, formData) {

            return  axios({
                method: 'POST',
                url: `/api/admin/categories/${formData.get('id')}`,
                data: formData,
                headers: {
                    'Content-Type': 'multipart/form-data'
                }})
                .then((response) => {
                    if (response.status === 200){
                        commit('edit_categories_to_state', response.data)
                        commit('set_errors_edit', [])
                        return response
                    }
                })
                .catch((error) => {
                    switch (error.response.status) {
                        case 422:
                            commit('set_errors_edit', error.response.data.errors)
                            return error.response.status
                            break;
                        default:
                            console.log(error)
                            break;
                    }
                })
        },

        //Удалить категорию
        categoryDeleteAdmin({commit}, {categoryId, index}) {
            return axios({
                method: 'DELETE',
                url: `/api/admin/categories/${categoryId}`,
            })
                .then((response) => {
                    if (response.status === 200){
                        commit('delete_categories_to_state', index)
                        return response
                    }
                })
                .catch((error) => {
                    console.log(error)
                })
        }

    },
    mutations: {
        set_categories_to_state(state, categories) {
            state.categories = categories
        },

        set_categories_admin_to_state(state, categories) {
            state.categoriesAdministrate = categories
        },


        add_category_to_state(state, category) {
            state.categoriesAdministrate.unshift(category)
            /*state.categoriesAdministrate.splice(state.categoriesAdministrate.length-1, 1)*/
        },

        edit_categories_to_state(state, category) {
            const index_edit_cat = state.categoriesAdministrate.findIndex(item => item.id === category.id)

            state.categoriesAdministrate.splice(index_edit_cat, 1, category)
        },

        add_load_categories(state, categories){
            categories.forEach(data => {
                state.categoriesAdministrate.push(data)
            })
        },

        delete_categories_to_state(state, index) {
            state.categoriesAdministrate.splice(index, 1)
        },


        set_categories_all(state, categories) {
            state.categoriesAll = categories
        },


        set_errors_edit(state, errors) {
            state.errorsEdit = errors
        },

        set_errors_create(state, errors) {
            state.errorsCreate = errors
        },

        set_categories_tree(state, categories){
            state.categoryTree = categories
        }


    },

    getters: {
        getCategories(state){
            return state.categories
        },

        getCategoriesForAdmin(state){
            return state.categoriesAdministrate
        },

        getCategoriesAll(state){
            return state.categoriesAll
        },

        getCategoriesTree(state) {
            return state.categoryTree
        },



        getErrorsCreateCategory(state) {
            return state.errorsCreate
        },

        getErrorsEditCategory(state) {
            return state.errorsEdit
        },


        getPaginateForCategories(state) {
            return state.paginate
        }

    }
}
