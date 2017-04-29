<template>
    <mu-appbar title="ADMIN">
        <mu-icon-button icon="menu" slot="left"/>
        <mu-flat-button href="#/test" label="TEST" slot="left"/>
        <mu-flat-button href="#/" label="HOME" slot="left"/>
        <mu-flat-button href="#/article" label="Article" slot="left"/>
        <mu-flat-button href="#/user" label="User" slot="left"/>
        <mu-flat-button href="#/personalcenter" label="PersonalCenter" slot="right"/>
    </mu-appbar>
</template>

<script>
    export default {
        name: 'admin-head',
        data(){
            return {
                isActive: true, hasError: true
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
