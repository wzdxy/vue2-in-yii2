<template>
    <mu-appbar style="transition: all .45s cubic-bezier(.23,1,.32,1);width: inherit;" v-bind:style="{'margin-left':routerMarginLeft}">
        <mu-icon-button icon="menu" @click="toggle()" slot="left"/>
        <mu-flat-button href="#/login" label="Login" slot="right" v-if="!isLogin"/>
        <mu-flat-button href="#/signup" label="SignUp" slot="right" v-if="!isLogin"/>
        <mu-flat-button href="#/post" label="Post" slot="left" v-if="isLogin"/>
        <mu-flat-button color="white" label="logout" slot="right" v-on:click="logout" v-if="isLogin"/>
        <mu-drawer :open="open && isLogin" :docked="docked" @close="toggle()">
            <mu-list @itemClick="docked ? '' : toggle()">
                <mu-list-item href="#/article" title="Article"/>
                <mu-list-item href="#/user" title="User"/>
                <mu-list-item href="#/post" title="Post"/>
                <mu-list-item href="#/settings" title="Settings"/>
                <mu-list-item v-if="docked" @click.native="toggle()" title="Close"/>
            </mu-list>
        </mu-drawer>
    </mu-appbar>
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
            toggle (flag) {
                this.open = !this.open;
                this.docked = !flag;
                this.$emit('drawerToggle',this.open);
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
