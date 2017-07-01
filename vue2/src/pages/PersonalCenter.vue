<template>
    <div id="PersonalCenter">
        <h2>PersonalCenter</h2>
        <p>用户名:{{user.id}}</p>
        <div style="padding: 10px;">
            <mu-text-field v-model="title" hintText="标题" type="text" icon="title" fullWidth=true /><br/>
            <mavon-editor v-model="md" v-on:change="editorChange" v-bind:toolbars="toolbars"/>
            <mu-text-field v-model="tag" hintText="标签" type="text" icon="label" slot="left" /><br/>

            <tag-editor></tag-editor>

            <mu-raised-button v-on:click="publish" label="Publish" slot="right" class="demo-raised-button" primary v-bind:disabled="loading" v-if="!loading"/>
            <mu-circular-progress :size="60" :strokeWidth="6" v-if="loading" slot="right"/>
        </div>
        <mu-popup position="top" :overlay="false" popupClass="demo-popup-top" :open="topPopup">{{msg}}</mu-popup>

    </div>
</template>

<script>
    import mavonEditor from 'mavon-editor'
    import 'mavon-editor/dist/css/index.css'
    import TagEditor from "../components/tagEditor";

    export default {
        name: 'app',
        data(){
            return {
                value:'',
                isActive: true, hasError: true,
                title:'',
                md:'',
                html:'',
                tag:'',
                topPopup: false,
                msg:'',
                loading:false,
                toolbars:{
                    bold: true, // 粗体
                    italic: true,// 斜体
                    header: true,// 标题
                    underline: true, // 下划线
                    strikethrough: true, // 中划线
                    quote: true, // 引用
                    ol: true, // 有序列表
                    ul: true, // 无序列表
                    link: true, // 链接
                    imagelink: true, // 图片链接
                    code: true, // code
                    table: true, // 表格
                    subfield: true, // 是否需要分栏
                    fullscreen: true, // 全屏编辑
//                    readmodel: true, // 沉浸式阅读
                    htmlcode: true, // 展示html源码
                    help: true, // 帮助
                    undo: true, // 上一步
                    redo: true, // 下一步
                    trash: true, // 清空
//                    save: true, // 保存（触发events中的save事件）
                }
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
                        md:this.md,
                        html:this.html
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

            /**
             * 清空编辑器
             */
            initEditor:function () {
                this.md='';
                this.title='';
            },
            open (position) {
                this[position + 'Popup'] = true
            },
            /**
             * md编辑器内容变化时触发
             * @param e
             * @param h
             */
            editorChange(e,h){
                this.html=h;
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
        },
        components:{
            TagEditor, 'mavon-editor': mavonEditor.mavonEditor
        }
    }
</script>

<style>

</style>
