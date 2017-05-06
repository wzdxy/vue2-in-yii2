/**
 * Created by Z on 2017/4/29.
 */
import Vue from 'Vue'
import Vuex from 'Vuex'
Vue.use(Vuex)
export default new Vuex.Store({
    state: {
        count: 0,
        user:{
            id:'admin'
        },
        token:'dwadw',
        isLogIn:false,
    },
    mutations:{
        login(state){
            state.isLogIn=true;
        },
        logout(state){
            state.isLogIn=false;
        }
    }
})
