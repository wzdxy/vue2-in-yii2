<template>
    <div id="SystemSetting">
        <mu-paper>
            <mu-bottom-nav :value="bottomNav" @change="handleBtnChange">
                <mu-bottom-nav-item value="personal" title="Personal" icon="person"/>
                <mu-bottom-nav-item value="system" title="System" icon="settings"/>
                <mu-bottom-nav-item value="theme" title="Theme" icon="color_lens"/>
            </mu-bottom-nav>
        </mu-paper>

        <div v-if="bottomNav === 'personal'">
            <h2>Personal</h2>
        </div>

        <div v-if="bottomNav === 'system'">
            <h2>System</h2>
        </div>

        <div v-if="bottomNav === 'theme'">
            <h2>Theme</h2>
        </div>
        <div class="footer">d</div>
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

</style>
