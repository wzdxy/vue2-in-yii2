<template>
    <div id="PersonalCenter">
        <h2>UserCenter</h2>
        <span>{{user.id}}</span>
        <div>
            <mu-text-field v-model="title" hintText="标题" type="text" icon="title"/><br/>
            <mu-text-field v-model="content" hintText="正文" multiLine :rows="10" :rowsMax="20" icon="assignment"/><br/>
            <mu-raised-button v-on:click="publish" label="Publish" class="demo-raised-button" primary/>
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
                content:''
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
                        id:this.title,
                        pw:this.content,
                    })
                ).then(function (res) {
                    console.log(res);
                    if(res&&res.data.result===0){

                    }else{

                    }
                }.bind(this))
            }
        }
    }
</script>

<style>

</style>
