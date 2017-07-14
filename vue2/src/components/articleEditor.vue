<template>
    <div id="article-editor">
        {{action}}
        <mu-text-field v-model="prop_title" hintText="标题" type="text" icon="title" fullWidth /><br/>

        <mavon-editor v-model="prop_md" v-on:change="editorChange" v-bind:toolbars="toolbars" :ishljs="false"/>

        <tag-editor  :selectedTags="tag"></tag-editor> <!--v-model="tag"-->

        <mu-raised-button v-on:click="publish" label="Publish" slot="right" class="demo-raised-button" primary v-bind:disabled="loading||!prop_title||!prop_md" v-if="!loading"/>
        <mu-circular-progress :size="60" :strokeWidth="6" v-if="loading" slot="right"/>
        <mu-popup position="top" :overlay="false" popupClass="demo-popup-top" :open="topPopup">{{msg}}</mu-popup>
    </div>
</template>

<script>
    import tagEditor from './tagEditor.vue'
    import mavonEditor from 'mavon-editor'
    import 'mavon-editor/dist/css/index.css'
    export default {
        name: 'article-editor',
        data(){
            return {
                value:'',
                prop_title:this.title||'',
                prop_md:this.md||'',
                prop_tag:this.tag||[],
                html:'',
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
                    readmodel: true, // 沉浸式阅读
                    htmlcode: true, // 展示html源码
                    help: true, // 帮助
                    undo: true, // 上一步
                    redo: true, // 下一步
                    trash: true, // 清空
//                    save: true, // 保存（触发events中的save事件）
//                    subfield: true,
                }
            }
        },
        props:['action','md','title','tag'],
        methods:{
            publish:function () {
                if(this.prop_title==='' || this.prop_md==='')return;
                this.loading=true;
                this.$http.post('/article/publish',this.$qs.stringify({
                        title:this.prop_title,
                        md:this.prop_md,
                        html:this.html,
                        tag:JSON.stringify(this.prop_tag)||''
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
                this.prop_md='';
                this.prop_title='';
                this.prop_tag=[]
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
            },
            prop_md:function (val) {
                this.$emit('update:md',val);
            },
            prop_title:function (val) {
                this.$emit('update:title',val);
            },
            prop_tag:function (val) {
                this.$emit('update:tag',tag);
            }
        },
        components:{
            'tag-editor':tagEditor, 'mavon-editor': mavonEditor.mavonEditor
        },
        mounted:function () {
            console.log(vm);
        }
    }
</script>

<style>

</style>
