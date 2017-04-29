import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import App from './App'
import store from '@/store/admin-store'
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

router.beforeEach((to,from,next)=>{
    if(to.meta.requireAuth){
        if(store.state.token){
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
        if(store.state.token){
            config.headers.Authorization=`token ${store.state.token}`
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
                    store.commit(types.LOGOUT);
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
