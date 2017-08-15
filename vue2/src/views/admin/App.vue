<template>
    <div id="app" class="wrapper">
        <admin-head></admin-head>
        <main class="body-wrapper">
            <admin-nav></admin-nav>
            <router-view class="content-wrapper"></router-view>
        </main>
        <footer class="footer-wrapper"></footer>
    </div>
</template>

<script>
    export default {
        name: 'app',
        data(){
            return {
                isActive: true, hasError: true,
            }
        },
        computed: {
            loginState: function () {
                return this.$store.state.user.log;
            },
        },
        methods:{
            login:function () {
                let state=this.$store.state.user.log;
                if(state){
                    this.$store.commit('logout');
                }else{
                    this.$store.commit('login');
                }
            },
        }
    }
</script>

<style>
    #app {
        font-family: 'Avenir', Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        color: #2c3e50;
        position: fixed;
        display: flex;
        flex-direction: column;
        width: 100vw;
        height: 100vh;
    }
    html,body,#app{
        height: 100%;
    }
    body {
        padding: 0;
        margin: 0;
    }
</style>

<style scoped>
    .body-wrapper{
        display: flex;flex: 1;
    }
    .content-wrapper{
        transition: all .45s cubic-bezier(.23,1,.32,1);flex:1;
        display: flex;
        flex-direction: column;
        overflow: auto;
    }
    .footer-wrapper{
        display: flex;flex-direction: row;align-items: center;
    }
    @media (min-width:480px){
        .body-wrapper{
            flex-direction: row;
        }
    }
    @media (max-width:480px){   /*移动端*/
        .body-wrapper{
            flex-direction: column;
        }
    }
</style>
