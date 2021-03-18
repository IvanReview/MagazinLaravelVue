import * as paginate from "../helpers/paginate";

export default {
    state: {
        currency: {
            currency_coefficient: 1,
            currency_code: 'RUB',
        }


    },
    actions: {
        changeCurrencyInState({commit, state}, currency ) {

            let url = "/api/currency"
            return  axios({
                method: 'GET',
                url: url,
                params: {currency},
            })
                .then((response) => {

                    commit('set_currency', response.data)
                    return response

                })
                .catch((error) => {
                    console.log(error)
                })
        },

    },
    mutations: {

        set_currency(state, currency) {
            state.currency = currency

        },

    },

    getters: {
        getCurrency(state) {
            return state.currency
        },

    }
}
