<template>
    <div id="article-editor">
        <mu-text-field v-model="prop_title" hintText="标题" type="text" icon="title" style="width: 80%;"/>
        <mavon-editor v-model="prop_md" v-on:change="editorChange" v-bind:toolbars="toolbars" :ishljs="false"/>

        <div class="btn-group" style="float: right;padding: 20px;">
            <mu-raised-button  v-on:click="publish" label="Publish" slot="right" class="demo-raised-button" primary v-bind:disabled="loading||!prop_title||!prop_md" v-if="!loading && action=='add'"/>
            <mu-raised-button  v-on:click="update" label="Update" slot="right" class="demo-raised-button" primary v-bind:disabled="loading||!prop_title||!prop_md" v-if="!loading && action=='edit'"/>
            <mu-raised-button  v-on:click="exitEditor" label="Cancel" class="demo-raised-button"  v-if="!loading && action=='edit'"/>
            <mu-circular-progress :size="60" :strokeWidth="6" v-if="loading" slot="right" class="loading-circular"/>
        </div>
        <tag-editor  :selectedTags.sync="prop_tag" style="float: right;width: 65%;"></tag-editor>
        <div style="float: left;width: 130px;overflow: hidden;">
            <mu-date-picker v-model="post_date" hintText="Current Date" style="width: 200px;"/><br/>
            <mu-time-picker v-model="post_time" hintText="Current Time" format="24hr"/><br/>
            <mu-text-field hintText="Custom Url" v-model="custom_url"/><br/>
        </div>

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
                post_time:'',
                post_date:'',
                custom_url:'',
                topPopup: false,
                msg:'',
                loading:false,
                toolbars:{
                    bold: true, // 粗体
                    italic: true,// 斜体
                    header: true,// 标题
                    underline: true, // 下划线
                    strikethrough: true, // 中划线
                    superscript: true, // 上角标
                    subscript: true, // 下角标
                    quote: true, // 引用
                    ol: true, // 有序列表
                    ul: true, // 无序列表
                    link: true, // 链接
                    imagelink: true, // 图片链接
                    code: true, // code
                    table: true, // 表格

                    /* 2.1.8 */
                    alignleft: true, // 左对齐
                    aligncenter: true, // 居中
                    alignright: true, // 右对齐
//                    navigation: true, // 导航目录
//                    subfield: true, // 是否需要分栏
                    fullscreen: true, // 全屏编辑
//                    readmodel: true, // 沉浸式阅读
                    htmlcode: true, // 展示html源码
                    help: true, // 帮助
                    preview: true, // 预览
//                    undo: true, // 上一步
//                    redo: true, // 下一步
//                    trash: true, // 清空
//                    save: true, // 保存（触发events中的save事件）
//                    subfield: true,
                }
            }
        },
        props:{
            action: {type:String,default:''},
            id:{type:Number,default:-1},
            md: {type:String,default:''},
            title: {type:String,default:''},
            tag:{type:Array,default:()=>[]}
        },
        methods:{
            /**
             * 发布新文章
             */
            publish:function () {
                if(this.prop_title==='' || this.prop_md==='')return;
                this.loading=true;
                this.$http.post('/article/publish',this.$qs.stringify({
                        title:this.prop_title,
                        md:this.prop_md,
                        html:this.html,
                        tag:JSON.stringify(this.prop_tag)||'',
                        time:this.getPostTime(),
                        url:this.custom_url,
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
             * 更新文章
             */
            update(){
                if(this.prop_title==='' || this.prop_md==='')return;
                this.loading=true;
                this.$http.post('/article/update',this.$qs.stringify({
                        id:this.id,
                        title:this.prop_title,
                        md:this.prop_md,
                        html:this.html,
                        tag:JSON.stringify(this.prop_tag)||'',
                        time:this.getPostTime(),
                        url:this.custom_url,
                    })
                ).then(function (res) {
                    this.loading=false;
                    if(res&&res.data.result===0){
                        this.msg='Update Success';
                        this.$emit('exit');
                        this.initEditor(); //TODO emit 到父级以隐藏编辑区
                    }else{
                        this.msg=res.data.message;
                    }
                    this.open('top');
                }.bind(this)).catch(function (err) {
                    this.loading=false;
                    this.msg='Update Failed';
                    this.open('top');
                }.bind(this));
            },
            getPostTime(){
                let c=new Date();
                if(this.post_date){
                    let dateArray=this.post_date.split('-');
                    c.setYear(dateArray[0]);
                    c.setMonth(dateArray[1]);
                    c.setDate(dateArray[2]);
                }
                if(this.post_time){
                    let timeArray=this.post_time.split(':');
                    c.setHours(timeArray[0]);
                    c.setMinutes(timeArray[1]);
                }
                return `${c.getFullYear()}-${c.getMonth()}-${c.getDate()} ${c.getHours()}:${c.getMinutes()}:${c.getSeconds()}`;
//                return `${c.getFullYear()}-${String(c.getMonth()).padStart(2,'0')}-${String(c.getDate()).padStart(2,'0')} ${String(c.getHours()).padStart(2,'0')}:${String(c.getMinutes()).padStart(2,'0')}:${String(c.getSeconds()).padStart(2,'0')}`;
            },
            /**
             * 清空编辑器
             */
            initEditor:function () {
                this.prop_md='';
                this.prop_title='';
                this.prop_tag=[]
            },
            exitEditor:function () {
                this.$emit('exit');
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
                this.$emit('update:tag',val);
            }
        },
        components:{
            'tag-editor':tagEditor, 'mavon-editor': mavonEditor.mavonEditor
        },
        mounted:function () {

        }
    }
</script>

<style>
    .demo-raised-button,.loading-circular{
        /*position: absolute;*/
        /*left: calc(50% - 45px);*/
    }
</style>
