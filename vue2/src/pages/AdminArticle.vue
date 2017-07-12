<template>
    <div id="AdminArticle">
        <h2>Article</h2>
        <mu-table :enableSelectAll="true" :multiSelectable="true"
                  :selectable="true" :showCheckbox="true">
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
        <div v-if="isEditing" class="edit-container" >
            <article-editor action="add" :md="editingMd" :title="editingTitle"></article-editor>
        </div>
    </div>
</template>

<script>
    import articleEditor from "../components/articleEditor.vue"
    export default {
        name: 'app',
        data(){
            return {
                isActive: true, hasError: true,
                articleList:[
                    {title:'N1',author_name:'LL'},
                    {title:'N1',author_name:'LL'},
                ],
                isEditing:false,
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
                this.isEditing=true;
                this.editingTitle=title;
                vm.$http.get('/article/text?id='+id).then(function (res) {
                    if(res.data.result===0){
                        this.editingMd=res.data.content;
                    }else{
                        this.isEditing=false;
                        alert(JSON.stringify(res));
                    }

                }.bind(this))
            },
        },
        beforeRouteEnter(to,from,next){
            let This=this;
            vm.$http.get('/article/list').then(function (res) {
                next((vm)=>{
                    if(res.data.result===0){
                        vm.articleList=res.data.list;
                    }
                });
            });
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
        top: 80px;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 2001;
    }
</style>
