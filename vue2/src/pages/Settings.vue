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
                <h2>Backup</h2>
                <form action="#">
                    <h3>Import From Ghost</h3>
                    <mu-text-field  label="ImportFrom Ghost" icon="title" type="file" fullWidth/><br/>
                    <mu-raised-button label="Import" class="demo-raised-button" primary style="w100px"/>
                </form>
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
    </div>
</template>

<script>
    export default {
        name: 'SystemSetting',
        data () {
            return {
                activeTab: 'personal',
                bottomNav: 'personal'
            }
        },
        methods: {
            handleTabChange (val) {
                this.activeTab = val
            },
            handleBtnChange (val) {
                this.bottomNav = val
            }
        }
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
    .tab-item form{
        margin: 0 auto;
        display: flex;
        flex-direction: column;
    }
    .tab-item form .mu-text-field{
        margin:0 auto;
    }
    @media (min-width: 480px) {
        .tab-item form{
            max-width:30%;
        }
    }
    @media (max-width: 480px) {
        .tab-item form{
            max-width:90%;
        }
    }
</style>
