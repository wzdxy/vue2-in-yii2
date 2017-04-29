<template>
    <div id="Login">
        <h2>请登录</h2>
        <mu-text-field v-model="id" label="ID" hintText="请输入ID" labelFloat/><br/>
        <mu-text-field v-model="pw" label="密码" hintText="请输入密码" type="password" labelFloat/><br/>
        <mu-raised-button label="Primary" class="demo-raised-button" primary/>
        <p>上次登录:{{user.id}}</p>
        <p >输入的密码:{{pw}}</p>
    </div>
</template>

<script>
    export default {
        name: 'Login',
        data(){
            return {
                isActive: true, hasError: true,
                id:'',
                pw:'',
                error:'',
            }
        },
        computed:{
            user(){
                return this.$store.state.user
            }
        },
        methods:{
            isLogin:function () {

            }
        }
    }
</script>

<style>

</style>
