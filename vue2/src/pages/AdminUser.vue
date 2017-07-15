<template>
    <div id="AdminUser">
        <h2 style="padding-left: 30px;">User</h2>
        <mu-table :enableSelectAll="true" :multiSelectable="true"
                  :selectable="true" :showCheckbox="true">
            <mu-thead slot="header">
                <mu-tr>
                    <mu-th tooltip="ID">序号</mu-th>
                    <mu-th tooltip="名称">ID</mu-th>
                    <mu-th tooltip="状态">Name</mu-th>
                    <mu-th tooltip="状态">Email</mu-th>
                    <mu-th tooltip="状态">Create Time</mu-th>
                </mu-tr>
            </mu-thead>
            <mu-tbody>
                <mu-tr v-for="item,index in userList"  :key="index" :selected="item.selected">
                    <mu-td>{{index + 1}}</mu-td>
                    <mu-td>{{item.id}}</mu-td>
                    <mu-td>{{item.username}}</mu-td>
                    <mu-td>{{item.email}}</mu-td>
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
                userList: []
            }
        },
        beforeRouteEnter(to,from,next){
            let This=this;
            vm.$http.get('/user/list').then(function (res) {
                next((vm)=>{
                    if(res.data.result===0){
                        vm.userList=res.data.list;
                    }
                });
            });
        }
    }
</script>

<style>

</style>
