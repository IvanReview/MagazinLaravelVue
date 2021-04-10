import * as paginate from "../helpers/paginate";
let currencyInStore = window.localStorage.getItem('currency');


export default {
    state: {
        currency: currencyInStore ? JSON.parse(currencyInStore) : {currency_coefficient: 1, currency_code: 'RUB', id: 1}

    },
    actions: {
        changeCurrencyInState({commit, state}, currency_code ) {

            let url = "/api/currency"
            return  axios({
                method: 'GET',
                url: url,
                params: {currency_code},
            })
                .then((response) => {

                    commit('set_currency', response.data)
                    window.localStorage.setItem('currency', JSON.stringify(response.data));
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
