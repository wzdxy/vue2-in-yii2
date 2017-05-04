<template>
    <div id="PersonalCenter">
        <h2>UserCenter</h2>
        <span>{{user.id}}</span>
        <div>
            <mu-text-field v-model="title" hintText="标题" type="text" icon="title"/><br/>
            <mu-text-field v-model="content" hintText="正文" multiLine :rows="10" :rowsMax="20" icon="assignment"/><br/>
            <mu-raised-button v-on:click="publish" label="Publish" class="demo-raised-button" primary/>
            <mu-popup position="top" :overlay="false" popupClass="demo-popup-top" :open="topPopup">{{msg}}</mu-popup>
        </div>
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
                topPopup: false,
                msg:''
            }
        },
        computed:{
            user(){
                return this.$store.state.user
            }
        },
        methods:{
            publish:function () {
                this.$http.post('/article/publish',this.$qs.stringify({
                        title:this.title,
                        content:this.content,
                    })
                ).then(function (res) {
                    if(res&&res.data===0){
                        this.msg='成功';
                    }else{
                        this.msg=res.statusText;
                    }
                    this.open('top');
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

</style>
