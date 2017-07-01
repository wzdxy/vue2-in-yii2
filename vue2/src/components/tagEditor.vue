<template>
    <div id="tagEditor">
        <div class="edit-areas">
            <span class="selected-tag-box">
                <span v-for="( tag , idx ) in selectedTags" class="selected-tag">
                    {{tag.name}}
                    <span class="del-tag-btn" v-on:click="deleteTag(idx)">x</span>
                </span>
            </span>
            <input type="text" v-model="newTagInput" class="tag-input" @keyup.enter="addTag" @keyup.delete="backspaceKeyDelete"></div>
            <div class="exist-tag-box">
                <span v-for="( tag , idx) in existTags" v-if="!existTags[idx].selected" class="exist-tag" v-on:click="selectTag(idx)">{{tag.name}}</span>
            </div>
    </div>
</template>

<script>
    export default {
        name: 'tag-editor',
        data(){
            return {
                selectedTags:[
                        {name:'linux',isNew:false}
                    ],
                existTags:[
                        {name:'js',selected:false},{name:'php',selected:false},{name:'linux',selected:true}
                    ],
                newTagInput:''
            }
        },
        methods:{
            addTag:function () {
                this.selectedTags.push({name:this.newTagInput,isNew:!this.isInputExist});
                this.newTagInput='';
            },
            selectTag:function (idx) {
                let targetTag=this.existTags[idx];
                if(targetTag.selected===false){
                    this.selectedTags.push(targetTag);
                    targetTag.selected=true;
                }
            },
            deleteTag:function (idx) {
                let targetTag=this.selectedTags[idx];
                if(!targetTag.isNew)this.existTags.filter(function (item) {
                    return item.name===targetTag.name;
                }.bind(this))[0].selected=false;
                this.selectedTags.splice(idx,1);
            },
            backspaceKeyDelete:function () {
                if(!this.newTagInput)this.deleteTag(this.selectedTags.length-1);
            }
        },
        computed:{
            isInputExist:function () {
                let This=this;
                return this.existTags.filter(function (item) {return item.name===This.newTagInput;}).length>0;
            }
        }
    }
</script>

<style>
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
