<template>
    <div id="tagEditor">
        <div class="edit-areas">
            <span class="selected-tag-box">
                <span v-for="( tag , idx ) in prop_selectedTag" class="selected-tag">
                    {{tag.name}}
                    <span class="del-tag-btn" v-on:click="deleteTag(idx)">x</span>
                </span>
            </span>
            <input type="text" v-model="newTagInput" class="tag-input" @keydown.enter="addTag" @keydown.delete="backspaceKeyDelete"></div>
            <div class="exist-tag-box">
                <span v-for="( tag , idx) in existTags" v-if="!existTags[idx].selected" class="exist-tag" v-on:click="selectTag(idx)">{{tag.name}}</span>
            </div>
    </div>
</template>

<script>
    export default {
        name: 'tagEditor',
        data(){
            return {
                prop_selectedTag:this.selectedTags,
                existTags:[],
                newTagInput:''
            }
        },
        props:{
                selectedTags:{
                    type:Array,
                    default:function(){return []}
                }
            },
        methods:{
            addTag:function () {
                if(this.newTagInput!==''){
                    this.prop_selectedTag.push({name:this.newTagInput,isNew:!this.isInputExist});
                    this.newTagInput='';
                }
            },
            selectTag:function (idx) {
                let targetTag=this.existTags[idx];
                if(targetTag.selected===false){
                    this.prop_selectedTag.push({name:targetTag.name,isNew:false});
                    targetTag.selected=true;
                }
            },
            deleteTag:function (idx) {
                let targetTag=this.prop_selectedTag[idx];
                if(!targetTag.isNew)this.existTags.filter(function (item) {
                    return item.name===targetTag.name;
                }.bind(this))[0].selected=false;
                this.prop_selectedTag.splice(idx,1);
            },
            backspaceKeyDelete:function () {
                if(!this.newTagInput)this.deleteTag(this.prop_selectedTag.length-1);
            }
        },
        computed:{
            isInputExist:function () {
                let This=this;
                return this.existTags.filter(function (item) {return item.name===This.newTagInput;}).length>0;
            },
//            selectedTags:function () {
//                return this.value;
//            }
        },
        /**
         * 获取已存在的Tags
         */
        mounted:function(){
            let This=this;
            vm.$http.get('/tag/list').then(function (res) {
                if(res.data.result===0){
                    This.existTags=[];
                    for(let i=0,m=res.data.list.length;i<m;i++){
                        This.existTags.push({name:res.data.list[i].name,selected:false});
                    }
                }
            });
        },
        watch:{
            prop_selectedTag:function (val) {
                this.$emit('update:selectedTag',val)
            }
        }
    }
</script>

<style>
    #tagEditor{
        padding:15px 0;
        text-align: center;
    }
    .edit-areas,.exist-tag-box{
        min-height: 30px;
    }
    .exist-tag,.selected-tag{
        padding:2px 6px;
        margin:0 2px;
        border: 1px solid;
        display: inline-block;
    }
    .exist-tag{
        cursor: pointer;
    }
    .tag-input{
        border: none;
        border-bottom: 1px solid;
        outline: none;
    }
    .del-tag-btn{
        color: #ee4444;
        cursor: pointer;
    }
</style>
