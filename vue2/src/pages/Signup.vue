<template>
    <div id="Signup">
        <h2>Sign Up</h2>
        <mu-text-field v-model="id" label="Name" hintText="请输入用户名" labelFloat/><br/>
        <mu-text-field v-model="email" label="Email" hintText="请输入邮箱" labelFloat/><br/>
        <mu-text-field @keyup.native.enter="submit" v-model="pw" label="Password" hintText="请输入密码" type="password" labelFloat/><br/>
        <mu-raised-button v-on:click="submit" label="SignUp" class="demo-raised-button" primary/>
        <p >输入的密码:{{pw}}</p>
        <mu-popup position="top" :overlay="false" popupClass="demo-popup-top" :open="topPopup">{{error}}</mu-popup>
    </div>
</template>

<script>
    export default {
        name: 'Signup',
        data(){
            return {
                isActive: true, hasError: true,
                id:'',
                pw:'',
                email:'',
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
            submit:function () {
                this.$http.post('/site/signup',this.$qs.stringify({
                        username:this.id,
                        password:this.pw,
                        email:this.email,
                    })
                ).then(function (res) {
                    if(res&&res.data.result===0){
                        window.localStorage.token_key=res.data.token;
                        window.localStorage.token_time=new Date().getTime()+1000*60*60;
                        let redirect=this.$route.query.redirect||'/personalcenter';
                    }else{
                        this.error=res.data.message;
                        this.open('top');
                    }
                }.bind(this))
            },
            open (position) {
                this[position + 'Popup'] = true
            },
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
