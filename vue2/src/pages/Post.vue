<template>
    <div id="Post">
        <!--<h2>PersonalCenter</h2>-->
        <!--<p>用户名:{{user.id}}</p>-->
        <div style="padding: 10px;">
            <article-editor action="add" :title.sync="title"></article-editor>
        </div>
    </div>
</template>

<script>
    import articleEditor from "../components/articleEditor.vue"

    export default {
        name: 'app',
        data(){
            return {
                title:'标题'
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

        },
        watch: {

        },
        components:{
            'article-editor':articleEditor
        },
    }
</script>

<style>

</style>
