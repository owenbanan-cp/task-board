import store from './store/store';

export async function isAuthenticated() {
    try {
        await axios.get('/api/check-auth');
        return true
    } catch (error) {
        return false
    }
}
export async function checkAuthentication(to, from, next) {
    const isAuth = await isAuthenticated();
    store.commit('authentication/setAuthentication', isAuth)
    if (to.meta.auth && ! isAuth) {
        next({name: 'Login'})
    }
    else if (to.meta.guest && isAuth) {
        next({name: 'Home'})
    } else {
        next();
    }
}
