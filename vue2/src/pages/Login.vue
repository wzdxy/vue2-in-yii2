<template>
    <div id="Login">
        <h2>请登录</h2>
        <form action="#">
            <mu-text-field v-model="id" label="ID" hintText="请输入ID" labelFloat/><br/>
            <mu-text-field @keyup.native.enter="submit" v-model="pw" label="密码" hintText="请输入密码" type="password" labelFloat/><br/>
            <mu-raised-button v-on:click="submit" label="Login" class="demo-raised-button" primary v-bind:disabled="loading" v-if="!loading"/>
            <mu-popup position="top" :overlay="false" popupClass="demo-popup-top" :open="topPopup">{{msg}}</mu-popup>
        </form>
        <mu-circular-progress :size="60" :strokeWidth="7" v-if="loading"/>
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
                this.loading=true;
                this.$http.post('/site/login',this.$qs.stringify({
                        id:this.id,
                        pw:this.pw,
                    })
                ).then(function (res) {
                    this.loading=false;
                    this.msg=res.data.message;
                    this.pw='';
                    if(res&&res.data.result===0){
                        this.$store.commit('login',{id:this.id});
                        window.localStorage.token_key=res.data.token;
                        window.localStorage.user_id=this.id;
                        window.localStorage.token_time=new Date().getTime()+1000*60*60;
                        let redirect=this.$route.query.redirect||'/personalcenter';
                        this.$router.replace(redirect);
                    }else{

                    }
                    this.open('top');
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
    #Login{
        text-align: center;
    }
</style>
