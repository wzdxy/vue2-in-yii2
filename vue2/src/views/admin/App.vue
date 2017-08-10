<template>
    <div id="app">
        <admin-head v-on:drawerToggle="toggle"></admin-head>
        <router-view style="transition: all .45s cubic-bezier(.23,1,.32,1)" v-bind:style="{'margin-left':routerMarginLeft}"></router-view>
    </div>
</template>

<script>
    export default {
        name: 'app',
        data(){
            return {
                isActive: true, hasError: true,
                drawerOpen:true
            }
        },
        computed: {
            loginState: function () {
                return this.$store.state.user.log;
            },
            routerMarginLeft:function () {
                return this.drawerOpen && this.loginState?'260px':'0px';
            }
        },
        methods:{
            login:function () {
                let state=this.$store.state.user.log;
                if(state){
                    this.$store.commit('logout');
                }else{
                    this.$store.commit('login');
                }
            },
            toggle(open){
                this.drawerOpen=open;
            }
        }
    }
</script>

<style>
    #app {
        font-family: 'Avenir', Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        /*text-align: center;*/
        color: #2c3e50;
    }

    body {
        padding: 0;
        margin: 0;
    }
</style>
