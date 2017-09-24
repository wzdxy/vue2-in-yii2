<template>
    <nav v-if="loginState" class="nav-wrapper" :class="{open:isOpen,slim:isSlim}">
        <div v-if="isOpen" class="overlay" @click="toggleOpen"></div>
        <mu-list class="menu-list" @itemClick="toggleOpen()">
            <mu-list-item v-for="(item,idx) in list" :href="item.href" :key="item.title" :title="item.title">
                <mu-icon slot="left" :value="item.icon"/>
            </mu-list-item>
        </mu-list>
    </nav>
</template>

<script>
    export default {
        data() {
            return {
                list:[
                    {href:'#/post',title:'Post',icon:'add_circle_outline'},
                    {href:'#/article',title:'Article',icon:'playlist_add_check'},
                    {href:'#/user',title:'User',icon:'group'},
                    {href:'#/setting',title:'Settings',icon:'settings'},
                ]
            }
        },
        components: {},
        props: {},
        computed: {
            loginState: function () {
                return this.$store.state.user.log;
            },
            isOpen:function () {
                return this.$store.state.mobileMenu.isOpen;
            },
            isSlim:function () {
                return this.$store.state.mobileMenu.isSlim;
            }
        },
        methods: {
            toggleOpen (e) {
                this.$store.commit('toggleNavOpen');
            },
        }
    }
</script>

<style>
    .nav-wrapper{
        transition: all .4s;
    }
    @media (min-width: 480px) {
        .nav-wrapper {
            width: 200px;
            box-shadow: 0 1px 6px rgba(0,0,0,.117647), 0 1px 4px rgba(0,0,0,.117647);
            margin-right: 2px;
        }
        .nav-wrapper.slim {
            width:56px;
        }
        .overlay{
            display: none;
        }
    }

    @media (max-width: 480px) {
        /*移动端*/
        .nav-wrapper {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            width: 0;
            overflow: hidden;
            z-index: 9999;
            background-color: #fff;
            box-shadow: 0 1px 6px rgba(0,0,0,.117647), 0 1px 4px rgba(0,0,0,.117647);
        }

        .nav-wrapper.open {
            width: 80%;
            display: inline-block;

        }
        .overlay{
            position: fixed;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }
        .menu-list{
            z-index:2;
            height: 100%;
            background-color: #ffffff;

        }
    }


</style>
