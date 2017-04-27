
// import Vue from 'vue'
// import App from './listApp'

// new Vue({
//   render: h => h(App)
// }).$mount('#app')

// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'


Vue.config.productionTip = false

Vue.component('component-example',{
  template:'<div v-bind:style="style">This is A custom component!<br>{{msg}}</div>',
  data:function(){
    return{msg:'我是一个组件，我来自main.js中的定义',style:{border:"1px solid",margin:"2px"}}
  }
})



/* eslint-disable no-new */
window.vm=new Vue({
  el: '#app',
  template: '<App/>',
  components: { App }
})
