<template>
    <div id="AdminArticle">
        <h2 v-show="!isEditing" style="padding-left: 30px;">Article</h2>
        <mu-table v-show="!isEditing" :enableSelectAll="true" :multiSelectable="true" :selectable="true" :showCheckbox="true">
            <mu-thead slot="header">
                <mu-tr>
                    <mu-th tooltip="ID">Index</mu-th>
                    <mu-th tooltip="名称">Title</mu-th>
                    <mu-th tooltip="状态">Author</mu-th>
                    <mu-th tooltip="状态">Create Time</mu-th>
                    <mu-th tooltip="状态">Operation</mu-th>
                </mu-tr>
            </mu-thead>
            <mu-tbody>
                <mu-tr v-for="item,index in articleList"  :key="index" :selected="item.selected">
                    <mu-td>{{index + 1}}</mu-td>
                    <mu-td>{{item.title}}</mu-td>
                    <mu-td>{{item.author_name}}</mu-td>
                    <mu-td>{{item.created_at }}</mu-td>
                    <mu-td>
                        <mu-icon-button touch icon="delete" @click="deleteArticle(item.id)"/>
                        <mu-icon-button touch icon="edit" @click="editArticle(item.id,item.title)"/>
                    </mu-td>
                </mu-tr>
            </mu-tbody>
        </mu-table>
        <div v-if="isEditing" class="edit-container" style="overflow:auto;">
            <article-editor action="edit" :id="editingId" :md.sync="editingMd" :title="editingTitle" v-on:exit="exitEditing"></article-editor>
        </div>
        <mu-dialog :open="isLoading" title="加载中 - -">
            <p><mu-circular-progress :size="40"/></p>
        </mu-dialog>
    </div>
</template>

<script>
    import articleEditor from "../components/articleEditor.vue"
    export default {
        name: 'app',
        data(){
            return {
                isActive: true, hasError: true,
                isLoading:false,
                articleList:[
                    {title:'N1',author_name:'LL'},
                    {title:'N1',author_name:'LL'},
                ],
                isEditing:false,
                editingId:-1,
                editingMd:'',
                editingTitle:'',
            }
        },
        methods:{
            deleteArticle:function(id){
                event.stopPropagation();
                alert('delete '+id);
            },
            editArticle:function(id,title){
                event.stopPropagation();
                this.editingTitle=title;
                this.editingId=id;
                this.isLoading=true;
                vm.$http.get('/article/text?id='+id).then(function (res) {
                    this.isLoading=false;
                    if(res.data.result===0){
                        this.editingMd=res.data.content;
                        this.isEditing=true;
                    }else{
                        this.isEditing=false;
                        alert(JSON.stringify(res));
                    }

                }.bind(this));

            },
            exitEditing(){
                this.isEditing=false;
            },
            getArticleList(){
                this.isLoading=true;
                this.$http.get('/article/list').then(function (res) {
                    this.isLoading=false;
                    if(res.data.result===0){
                        this.articleList=res.data.list;
                    }
                }.bind(this));
            }
        },
        created(){
            this.getArticleList();
        },
        components:{
            'article-editor':articleEditor
        }
    }
</script>

<style>
    .edit-container{
        position: fixed;
        background-color: #fff;
        top: 60px;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 2001;
    }
</style>
