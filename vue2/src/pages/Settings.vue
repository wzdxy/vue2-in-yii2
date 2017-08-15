<template>
    <div id="SystemSetting">
        <div class="tab-content">
            <div v-if="bottomNav === 'personal'">
                <h2>Personal</h2>
            </div>

            <div v-if="bottomNav === 'system'">
                <h2>System</h2>
            </div>

            <div v-if="bottomNav === 'theme'">
                <h2>Theme</h2>
            </div>
        </div>
        <mu-paper>
            <mu-bottom-nav :value="bottomNav" @change="handleBtnChange">
                <mu-bottom-nav-item value="personal" title="Personal" icon="person"/>
                <mu-bottom-nav-item value="system" title="System" icon="settings"/>
                <mu-bottom-nav-item value="theme" title="Theme" icon="color_lens"/>
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

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .tab-content{
        flex:1;
        overflow: auto;
    }
</style>
