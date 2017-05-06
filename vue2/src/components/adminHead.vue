<template>
    <mu-appbar>
        <mu-flat-button href="#/" label="HOME" slot="left"/>
        <mu-flat-button href="#/article" label="Article" slot="left"/>
        <mu-flat-button href="#/user" label="User" slot="left"/>
        <mu-flat-button href="#/login" label="Login" slot="right" />
        <mu-flat-button href="#/signup" label="SignUp" slot="right"/>
        <mu-flat-button href="#/personalcenter" label="PersonalCenter" slot="right"/>
        <mu-flat-button color="white" label="logout" slot="right" v-on:click="logout"/>
    </mu-appbar>
</template>

<script>
    export default {
        name: 'admin-head',
        data(){
            return {
                isActive: true, hasError: true
            }
        },
        methods:{
            logout(){
                this.$store.commit('logout');
                window.localStorage.token_key=null;
                window.localStorage.token_time=null;
                this.$router.replace('/login');
            }
        },
        computed:{
            isLogin:function(){
                return this.$store.state.isLogIn;
            }
        }
    }
</script>

<style>
    #admin-head {
        height: 100px;
    }
    #admin-head>ul{
        border:1px solid ;
        display: inline-block;
    }
    #admin-head>ul>li{
        display: inline-block;
    }
</style>
