<template>
    <div id="Login">
        <h2>请登录</h2>
        <mu-text-field v-model="id" label="ID" hintText="请输入ID" labelFloat/><br/>
        <mu-text-field @keyup.enter="submit" v-model="pw" label="密码" hintText="请输入密码" type="password" labelFloat/><br/>
        <mu-raised-button v-on:click="submit" label="Login" class="demo-raised-button" primary/>
        <p>上次登录:{{user.id}}</p>
        <p >输入的密码:{{pw}}</p>

        <mu-popup position="top" :overlay="false" popupClass="demo-popup-top" :open="topPopup">{{error}}</mu-popup>
    </div>
</template>

<script>
//    import axios from 'axios'
    export default {
        name: 'Login',
        data(){
            return {
                isActive: true, hasError: true,
                id:'',
                pw:'',
                error:'',
                topPopup: false,
            }
        },
        computed:{
            user(){
                return this.$store.state.user
            }
        },
        methods:{
            isLogin:function () {

            },
            submit:function () {
                this.$http.post('/site/login',this.$qs.stringify({
                        id:this.id,
                        pw:this.pw,
                    })
                ).then(function (res) {
                    if(res&&res.data.result===0){
                        window.localStorage.token_key=res.data.token;
                        window.localStorage.token_time=new Date().getTime()+1000*60*60;
                        let redirect=this.$route.query.redirect||'/';
                        this.$router.replace(redirect);
                    }else{
                        this.error=res.data.message;
                        this.open('top');
                    }
                }.bind(this))
            },
            open (position) {
                this[position + 'Popup'] = true
            },
            close (position) {
                this[position + 'Popup'] = false
            }
        },
        watch: {
            topPopup (val) {
                if (val) {
                    setTimeout(() => {
                        this.topPopup = false
                    }, 3000)
                }
            }
        }
    }
</script>

<style>
    .demo-popup-top {
        width: 100%;
        opacity: .9;
        height: 48px;
        line-height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        max-width: 375px;
    }
</style>
