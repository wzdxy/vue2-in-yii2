import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import qs from 'qs'
import App from './App'
import store from '@/store/store'
import MuseUI from 'muse-ui'
import 'muse-ui/dist/muse-ui.css'
import 'muse-ui/dist/theme-light.min.css'
import router from  "@/router/admin"
import Footer from  "@/components/adminFooter.vue"
import Head from "@/components/adminHead.vue"

Vue.use(MuseUI);
Vue.use(Vuex);
Vue.config.productionTip = false;
Vue.component('admin-head',Head);
Vue.component('admin-footer',Footer);

Vue.prototype.$http=axios;
Vue.prototype.$qs=qs;
router.beforeEach((to,from,next)=>{
    if(to.meta.requireAuth){
        // if(store.state.token){
        if(localStorage.token_key && localStorage.token_time > Date.now()){
            next();
        }else{
            next({
                path:'/login',
                query:{redirect:to.fullPath}
            })
        }
    }else{
        next();
    }
});

axios.interceptors.request.use(             //request 拦截器
    config=>{
        if(localStorage.token_key && localStorage.token_time > Date.now()){
            config.headers.Authorization=localStorage.token_key;
        }else{

        }
        return config;
    },
    err=>{return Promise.reject(err);});
axios.interceptors.response.use(            //response 拦截器
    response=>{
        return response;
    },
    error=>{
        if(error.response){
            switch (error.response.status){
                case 401:
                    localStorage.token_key=null;
                    router.replace({
                        path:'/login',query:{redirect:router.currentRoute.fullPath}
                    })

            }
        }
        return Promise.reject(error.response.data)
    }
);

window.vm=new Vue({
  el: '#app',
  router,store,
  template: '<App/>',
  components: { App }
});
