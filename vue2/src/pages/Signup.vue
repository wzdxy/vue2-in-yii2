<template>
    <div id="Signup">
        <h2>Sign Up</h2>
        <mu-text-field v-model="id" label="Name" hintText="请输入用户名" labelFloat/><br/>
        <mu-text-field v-model="email" label="Email" hintText="请输入邮箱" labelFloat/><br/>
        <mu-text-field @keyup.native.enter="submit" v-model="pw" label="Password" hintText="请输入密码" type="password" labelFloat/><br/>
        <mu-raised-button v-on:click="submit" label="SignUp" class="demo-raised-button" primary v-if="!loading"/>
        <mu-popup position="top" :overlay="false" popupClass="demo-popup-top" :open="topPopup">{{msg}}</mu-popup>
        <mu-circular-progress :size="60" :strokeWidth="7" v-if="loading"/>
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
                msg:'',
                topPopup: false,
                loading:false
            }
        },
        computed:{
            user(){
                return this.$store.state.user
            }
        },
        methods:{
            submit:function () {
                let That=this;
                this.loading=true;
                this.$http.post('/site/signup',this.$qs.stringify({
                        username:this.id,
                        password:this.pw,
                        email:this.email,
                    })
                ).then(function (res) {
                    this.loading=false;
                    if(res&&res.data.result===0){
                        window.localStorage.token_key=res.data.token;
                        window.localStorage.token_time=new Date().getTime()+1000*60*60;
                        let redirect=this.$route.query.redirect||'/personalcenter';
                        this.id='';
                        this.pw='';
                        this.email='';
                        setTimeout(function(){
                            That.$router.replace(redirect);
                        },2000);
                        this.msg='sign up success';
                        this.login()
                    }else{
                        this.msg=res.data.message;
                    }
                    this.open('top');
                }.bind(this))
            },
            open (position) {
                this[position + 'Popup'] = true
            },
            login:function () {
                console.log('auto log in after sign up'+this.id);
                this.$store.commit('login',{id:this.id});
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
