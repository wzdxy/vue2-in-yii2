<template>
    <div id="PersonalCenter">
        <h2>PersonalCenter</h2>
        <p>用户名:{{user.id}}</p>
        <div style="padding: 10px;">
            <mu-text-field v-model="title" hintText="标题" type="text" icon="title" fullWidth="true"/><br/>
            <mu-text-field v-model="content" hintText="正文" multiLine :rows="10" :rowsMax="20" icon="assignment" fullWidth="true"/><br/>
            <mu-text-field v-model="tag" hintText="标签" type="text" icon="label" slot="left" /><br/>
            <mu-raised-button v-on:click="publish" label="Publish" class="demo-raised-button" primary v-bind:disabled="loading" v-if="!loading"/>
            <mu-popup position="top" :overlay="false" popupClass="demo-popup-top" :open="topPopup">{{msg}}</mu-popup>
        </div>
        <mu-circular-progress :size="60" :strokeWidth="6" v-if="loading"/>
    </div>
</template>

<script>
    export default {
        name: 'app',
        data(){
            return {
                isActive: true, hasError: true,
                title:'',
                content:'',
                tag:'',
                topPopup: false,
                msg:'',
                loading:false
            }
        },
        computed:{
            isLogin(){
                return this.$store.state.isLogIn;
            },
            user(){
                return this.$store.state.user
            }
        },
        methods:{
            publish:function () {
                this.loading=true;
                this.$http.post('/article/publish',this.$qs.stringify({
                        title:this.title,
                        content:this.content,
                    })
                ).then(function (res) {
                    this.loading=false;
                    if(res&&res.data.result===0){
                        this.msg='发布成功';
                        this.initEditor();
                    }else{
                        this.msg=res.data.message;
                    }
                    this.open('top');
                }.bind(this))
            },
            initEditor:function () {
                this.content='';
                this.title='';
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

</style>
