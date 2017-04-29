<template>
  <div id="app">
    <admin-head></admin-head>
    <router-view></router-view>
    <!--<admin-footer></admin-footer>-->
  </div>
</template>

<script>
export default {
  name: 'app',
  data(){
    return {
        isActive:true,hasError:true
      }
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
  body{
    padding: 0;
    margin: 0;
  }
</style>
