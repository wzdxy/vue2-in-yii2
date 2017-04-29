
// import Vue from 'vue'
// import App from './listApp'

// new Vue({
//   render: h => h(App)
// }).$mount('#app')

// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from  "@/router/admin"
import Footer from  "@/components/adminFooter.vue"
import Test from "@/pages/Test.vue"
import Head from "@/components/adminHead.vue"
import AdminHome from "@/pages/AdminHome.vue"
import AdminUser from "@/pages/AdminUser.vue"
import AdminArticle from "@/pages/AdminArticle.vue"
import PersonalCenter from "@/pages/PersonalCenter.vue"
import MuseUI from 'muse-ui'
import 'muse-ui/dist/muse-ui.css'
import 'muse-ui/dist/theme-light.min.css'


Vue.config.productionTip = false;

Vue.component('Test',Test);
Vue.component('admin-head',Head);
Vue.component('admin-footer',Footer);
Vue.component('AdminHome',AdminHome);
Vue.component('AdminUser',AdminUser);
Vue.component('AdminArticle',AdminArticle);
Vue.component('UserCenter',PersonalCenter);
Vue.use(MuseUI);


/* eslint-disable no-new */
window.vm=new Vue({
  el: '#app',
  router,
  template: '<App/>',
  components: { App }
});
