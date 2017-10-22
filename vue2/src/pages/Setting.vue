<template>
    <div id="SystemSetting">
        <div class="tab-content">
            <div class="tab-item" v-show="bottomNav === 'personal'">
                <h2>Personal</h2>
                <form action="#">
                    <mu-text-field hintText="Name" label="Name" icon="person" fullWidth labelFloat/><br/>
                    <mu-text-field hintText="Email" label="Email" icon="email" type="email" fullWidth labelFloat/><br/>
                    <mu-text-field hintText="Description" label="Description" icon="subject" multiLine :rows="6" :rowsMax="10" fullWidth labelFloat/><br/>
                </form>
            </div>

            <div class="tab-item" v-show="bottomNav === 'system'">
                <h2>System</h2>
                <form action="#">
                    <mu-text-field hintText="Index Title" label="Index Title" icon="title" fullWidth labelFloat/><br/>
                    <mu-text-field hintText="Index Head" label="Index Head" icon="mood" fullWidth labelFloat/><br/>
                    <mu-text-field hintText="Page Description" label="Page Description" icon="subtitles" multiLine :rows="6" :rowsMax="10" fullWidth labelFloat/><br/>
                </form>
            </div>

            <div class="tab-item" v-show="bottomNav === 'theme'">
                <h2>Theme</h2>
            </div>
            <div class="tab-item" v-show="bottomNav === 'backup'">
                <h2>Import Articles</h2>
                <div class="btn-group-column">
                    <mu-raised-button label="Import Articles From Backup" primary @click="openImportModal('backup')"/>
                    <mu-raised-button label="Import Articles From Ghost" primary @click="openImportModal('ghost')"/>
                </div>
                <h2>Back Up Articles</h2>
                <div class="btn-group-column">
                    <mu-raised-button label="Backup Articles To File" primary href="/setting/backup?target=file"/>
                    <mu-raised-button label="Backup Articles To Email" primary />
                </div>
            </div>
        </div>
        <mu-paper>
            <mu-bottom-nav :value="bottomNav" @change="handleBtnChange">
                <mu-bottom-nav-item value="personal" title="Personal" icon="person"/>
                <mu-bottom-nav-item value="system" title="System" icon="settings"/>
                <mu-bottom-nav-item value="theme" title="Theme" icon="color_lens"/>
                <mu-bottom-nav-item value="backup" title="Backup" icon="backup"/>
            </mu-bottom-nav>
        </mu-paper>
        <mu-dialog :open="importModal" title="Import Articles From File" scrollable>
            <upload-file url="/setting/import" :additionalFormData="{type:'import',src:importFrom}" selectLabel="Select File" uploadLabel="Import">

            </upload-file>
            <mu-flat-button slot="actions" primary label="Cancel" @click="importModal=false"/>
            <mu-raised-button slot="actions" primary label="Import"/>
        </mu-dialog>
    </div>
</template>

<script>
    import uploadFile from '../components/uploadFile'
    export default {
        name: 'SystemSetting',
        data () {
            return {
                activeTab: 'personal',
                bottomNav: 'personal',
                importModal:false,
                importFrom:'self',
            }
        },
        methods: {
            handleTabChange (val) {
                this.activeTab = val
            },
            handleBtnChange (val) {
                this.bottomNav = val
            },
            openImportModal (importFrom){
                this.importModal=true;
                this.importFrom=importFrom;
            },
            backupToFile (){
                this.$http.get('/setting/backup?target=file').then(function (res) {
                    console.log(res)
                }.bind(this))
            }
        },
        components:{'upload-file':uploadFile}
    }
</script>

<style>

</style>
<style scoped>
    .tab-content{
        flex:1;
        overflow: auto;
    }
    .tab-item{
        padding-top: 5px;
    }
    .tab-item h2{
        text-align: center;
    }
    .tab-item form, .btn-group-column{
        margin: 0 auto;
        display: flex;
        flex-direction: column;
    }
    .tab-item form .mu-text-field, .btn-group-column{
        margin:0 auto;
    }
    .btn-group-column .mu-raised-button{
        margin-bottom: 10px;
    }
    @media (min-width: 480px) {
        .tab-item form, .btn-group-column{
            max-width:30%;
        }
    }
    @media (max-width: 480px) {
        .tab-item form, .btn-group-column{
            max-width:90%;
        }
    }
</style>
