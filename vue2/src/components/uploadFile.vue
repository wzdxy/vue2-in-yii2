<template>
    <div class="upload-file">
        <button class="check-file-btn" @click="checkFile">
            {{selectLabel}}
            <input type="file" class="files-input" ref="upload-file-input" @change="fileChanged">
        </button>
        <ol>
            <li v-for="(file, idx) in files">
                {{file.name}}
            </li>
        </ol>
        <slot name="actions"></slot>
        <div>
            <button @click="upload" :disabled="!files.length">{{uploadLabel}}</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'upload-file',
        data () {
            return {
                files:[],
            }
        },
        methods:{
            upload(){
                let formData=new FormData();
                for(let name in this.additionalFormData){
                    formData.append(name,this.additionalFormData[name]);
                }
                formData.append('file',this.files[0]);
                vm.$http.post(this.url,formData).then(function (res) {
                    console.log(res)
                })
            },
            fileChanged(e){
                console.log(e);
                this.files=e.target.files;
            },
            checkFile(){
                this.$refs['upload-file-input'].click();
            }
        },
        props:['url','additionalFormData','selectLabel','uploadLabel']
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .files-input{
        display: none;
    }
</style>
