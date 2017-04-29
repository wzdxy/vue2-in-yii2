<template>
    <div id="PersonalCenter">
        <h2>UserCenter</h2>
        <span>{{user.id}}</span>
    </div>
</template>

<script>
    export default {
        name: 'app',
        data(){
            return {
                isActive: true, hasError: true
            }
        },
        computed:{
            user(){
                return this.$store.state.user
            }
        }
    }
</script>

<style>

</style>
