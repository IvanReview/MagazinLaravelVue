import * as paginate from "../helpers/paginate";
let cart = window.localStorage.getItem('cart');


export default {
    state: {
        comments: [],
        commentsAll: [],
        paginationAdminComment: {},
        errorsWriteComment: [],


    },
    actions: {
        loadComments({commit, state}, page_url) {

            let url = page_url || "/api/admin/comments"
            return  axios({
                method: 'GET',
                url: url,
                params: {},
            })
                .then((response) => {

                    //задать различ парам пагинации
                    const pagination = paginate.makePaginationForAdmin(response.data)
                    commit('set_paginate_for_comment_admin', pagination)

                    commit('set_comments', response.data.data)
                    return true

                })
                .catch((error) => {
                    commit('set_errors_write_comment', error.response.data.errors)
                    console.log(error)
                })
        },

        loadAllComments({commit, state}, page_url) {

            let url = page_url|| "/api/admin/comments-all"
            return  axios({
                method: 'GET',
                url: url,
                params: {},
            })
                .then((response) => {
                    console.log(response)

                    commit('set_comments_all', response.data)
                    return true

                })
                .catch((error) => {
                    console.log(error)
                })
        },

        addCommentToDb({commit, state}, formData) {

            return axios({
                method: 'POST',
                url: `/api/product/${formData.product_id}/comment`,
                data: formData,
            })
                .then((response) => {
                    if (response.status === 200){
                        /*commit('accept_comment', response.data)*/
                        return response
                    }
                })
        },

        acceptComment({commit},formData) {
            return axios({
                method: 'POST',
                url: `/api/admin/comments/${formData.get("id")}`,
                data: formData,
                headers: {
                    'Content-Type': 'multipart/form-data'
                }})
                .then((response) => {
                    if (response.status === 200){
                        commit('accept_comment', response.data)
                        return response
                    }
                })
                .catch((error) => {
                    console.log(error)
                })
        },

        deleteCommentFromBd({commit}, {commentId, index}) {
            axios({
                method: 'DELETE',
                url: `/api/admin/comments/${commentId}`,
            })
                .then((response) => {
                    if (response.status === 200){
                        commit('delete_comment', index)
                        return response
                    }

                })
                .catch((error) => {
                    console.log(error)
                })

        },


    },
    mutations: {


        set_comments(state, comments) {
            state.comments = comments
        },

        set_comments_all(state, comments) {
            state.commentsAll = comments
        },


        set_paginate_for_comment_admin(state, paginate) {
            state.paginationAdminComment = paginate
        },


        accept_comment(state, comment) {
            let index = state.comments.findIndex(item => item.id == comment.id)
            state.comments.splice(index, 1, comment)
        },


        delete_comment(state, index) {
            state.comments.splice(index, 1)
        },

        set_errors_write_comment(state, errors) {
            state.errorsWriteComment  = errors
        }

    },

    getters: {
        getComments(state) {
            return state.comments
        },

        getPaginateComment(state) {
            return state.paginationAdminComment
        },

        getCommentsAll(state) {
            return state.commentsAll
        },

        getErrorsWriteComment(state) {
            return state.errorsWriteComment
        }


    }
}
