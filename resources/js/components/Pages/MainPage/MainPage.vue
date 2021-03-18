<template>
    <div class="main-page">
        <main>
            <section class="main">
                <div class="slider" style="background-image: url('/img/men-fa-left.jpg');">
                    <div class="container">
                        <div class="slider-text">
                            <h3 class="slider-text__head">Men’s Fashion</h3>
                            <div class="slider-text__body">
                                <span class="slider-text__body"> Home </span>
                                <span><i class="material-icons center">trending_flat</i></span>
                                <span class="slider-text__body"> Men </span>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="container">
                        <div class="main-content">

                            <!-- сайдбар -->
                            <Sidebar/>

                            <!-- основные продукты -->
                            <Products/>

                        </div>
                    </div>
                </div>
            </section>
        </main>

    </div>
</template>

<script>
    import Footer from "../CommonComponents/Footer";
    import Header from "../CommonComponents/Header";
    import Products from "./Products";
    import Sidebar from "./Sidebar";

    export default {
        name: "MainPage",
        components: {Sidebar, Products, Header, Footer},
        data: () => ({


        }),
        mounted() {
            M.AutoInit();

        }
    }
</script>

<style>
    .container {
        max-width: 1280px !important;
        width: 100%;
        margin: 0 auto;
    }
    .collapsible{
        border: none;
    }
    .widget-title{
        margin-bottom: 40px;
    }

</style>
