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
        mobileMenu:{
            isOpen:false,
            isSlim:false
        }
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
        toggleNavSlim(state){
            state.mobileMenu.isSlim=!state.mobileMenu.isSlim;
        },
        toggleNavOpen(state){
            state.mobileMenu.isOpen=!state.mobileMenu.isOpen;
        }
    }
})
