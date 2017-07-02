<template>
    <div id="AdminArticle">
        <h2>Article</h2>
        <mu-table :enableSelectAll="true" :multiSelectable="true"
                  :selectable="true" :showCheckbox="true">
            <mu-thead slot="header">
                <mu-tr>
                    <mu-th tooltip="ID">序号</mu-th>
                    <mu-th tooltip="名称">Title</mu-th>
                    <mu-th tooltip="状态">Author</mu-th>
                    <mu-th tooltip="状态">Create Time</mu-th>
                </mu-tr>
            </mu-thead>
            <mu-tbody>
                <mu-tr v-for="item,index in articleList"  :key="index" :selected="item.selected">
                    <mu-td>{{index + 1}}</mu-td>
                    <mu-td>{{item.title}}</mu-td>
                    <mu-td>{{item.author_name}}</mu-td>
                    <mu-td>{{item.created_at }}</mu-td>
                </mu-tr>
            </mu-tbody>
        </mu-table>
    </div>
</template>

<script>
    export default {
        name: 'app',
        data(){
            return {
                isActive: true, hasError: true,
                articleList:[
                    {name:'N1',status:'LL'},
                    {name:'N1',status:'LL'},
                ]
            }
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
        }
    }
</script>

<style>

</style>
