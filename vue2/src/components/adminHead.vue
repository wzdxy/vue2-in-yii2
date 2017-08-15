<template>
    <header class="admin-head">
        <mu-appbar class="head-bar">
            <mu-icon-button v-if="isLogin" class="nav-toggle-open-btn" icon="menu" @click="toggleOpen()" slot="left"/>
            <mu-icon-button v-if="isLogin" class="nav-toggle-slim-btn" icon="menu" @click="toggleSlim()" slot="left"/>
            <mu-flat-button href="#/login" label="Login" slot="right" v-if="!isLogin"/>
            <mu-flat-button href="#/signup" label="SignUp" slot="right" v-if="!isLogin"/>
            <mu-flat-button color="white" label="logout" slot="right" v-on:click="logout" v-if="isLogin"/>
        </mu-appbar>
    </header>
</template>

<script>
    export default {
        name: 'admin-head',
        data(){
            return {
                isActive: true, hasError: true,
                open:true,
                docked:true
            }
        },
        methods:{
            logout(){
                this.$store.commit('logout');
                window.localStorage.token_key=null;
                window.localStorage.token_time=null;
                this.$router.replace('/login');
            },
            toggleOpen (flag) {
                this.$store.commit('toggleNavOpen');
            },
            toggleSlim(){
                this.$store.commit('toggleNavSlim');
            }
        },
        computed:{
            isLogin:function(){
                return this.$store.state.user.log;
            },
            routerMarginLeft:function () {
                return this.open && this.isLogin?'256px':'0px';
            }
        }
    }
</script>

<style scoped>


    .head-bar{
        transition: all .45s cubic-bezier(.23,1,.32,1);width: inherit;height: 48px;
    }

    @media (min-width:480px){
        .nav-toggle-open-btn{
            display: none;
        }
        .nav-toggle-slim-btn{
            display: inline-block;
        }
    }
    @media (max-width:480px){   /*移动端*/
        .nav-toggle-open-btn{
            display: inline-block
        }
        .nav-toggle-slim-btn{
            display: none;
        }
    }
</style>
