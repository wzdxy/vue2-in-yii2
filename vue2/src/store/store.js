/**
 * Created by Z on 2017/4/29.
 */
import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)
export default new Vuex.Store({
    state: {
        count: 0,
        user: {
            id: '',
            log:false
        },
    },
    mutations: {
        login(state, user){
            state.user = {
                id:user.id,
                log:true
            };
        },
        logout(state){
            state.user = {
                id:'',
                log:false
            };
        },
    }
})
