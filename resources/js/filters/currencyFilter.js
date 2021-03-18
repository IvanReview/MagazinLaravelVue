export default function currencyFilter(value, currency ='RUB') {
    //у фильтра 1 пареметр значения(value) это то которое стоит до черты |, см документац Intl.NumberFormat
    return new Intl.NumberFormat('ru-Ru',{
        style: 'currency',
        currency: currency
    }).format(value)
}
