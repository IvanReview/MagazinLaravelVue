import store from '../store'
import jwt from 'jsonwebtoken'


//установить токкен в локальное хранилище
export function setToken(user){

    /*localStorage.setItem('laravel-vue-spa-token', JSON.stringify(user)) без шифровки*/
    //шифровка данных Юзера вместе с токеном
    const token = jwt.sign({ user: user }, 'laravelvue2020');
    localStorage.setItem('laravel-vue-spa-token', token);

    store.dispatch('authenticateAction', user.user);
    return true
}


//проверить залогирован ли пользователь
export function isLoggedIn() {
    const token = localStorage.getItem('laravel-vue-spa-token')
    return token != null
}

//получение и расшифровка токена
export function getAccessToken() {
    const token = localStorage.getItem('laravel-vue-spa-token')
    if(!token){
        return null
    }
    const tokenData = jwt.decode(token)
    //под ключем user лежат все данные, под ключем access_token соответств токен
    return tokenData.user.access_token
}

//получить профиль пользователя
export function getProfile() {
    const user = localStorage.getItem('laravel-vue-spa-token')
    if (! user) {
        return null
    }
    const dataFromStorage = jwt.decode(user)

    return dataFromStorage.user.user
}

//изменить профиль пользователя
export function changeProfile(userData) {
    const user = localStorage.getItem('laravel-vue-spa-token')
    if (! user) {
        return null
    }
    //расшифровываем данные и меняем данные юзера (токен не трогаем)
    let dataFromStorage = jwt.decode(user)
    dataFromStorage.user.user = userData


    //перезаписываем локальное хранилище
    const token = jwt.sign({ user: dataFromStorage.user }, 'laravelvue2020');
    localStorage.setItem('laravel-vue-spa-token', token);

    store.dispatch('authenticateAction', dataFromStorage.user.user);

    return true
}

//Получить роль юзера
export function getUserRole() {
    const token = localStorage.getItem('laravel-vue-spa-token')
    if(!token){
        return null
    }
    const tokenData = jwt.decode(token)
    return tokenData.user.user.role
}


