<template>
    <div class="app">
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        name: "App",
        mounted() {
        }
    }
</script>

<style>
    .app{
        min-height: 100%;
    }
    .container {
        max-width: 1280px !important;
        width: 100%;
        margin: 0 auto;
    }
    .helper-text.invalid{
        color:#f44336;
        text-align: left;
    }



</style>
