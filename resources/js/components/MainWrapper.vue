<template>
    <div class="main-wrapper">
        <Header />

        <router-view></router-view>


        <Footer/>
    </div>
</template>

<script>
    import Header from "./Pages/CommonComponents/Header";
    import Footer from "./Pages/CommonComponents/Footer";
    export default {
        name: "MainWrapper",
        components: {Footer, Header},
        mounted() {
            window.M.AutoInit();
            setTimeout(()=>{
                window.M.updateTextFields()
            },0)
        }
    }
</script>

<style >
    .helper-text.invalid{
        color:#f44336;
        text-align: left;
    }

</style>
