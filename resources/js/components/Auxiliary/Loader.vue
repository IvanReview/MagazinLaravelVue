<template>
    <div class="loader">
        <div class="preloader-wrapper big active">
            <div class="spinner-layer spinner-yellow-only">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Loader"
}
</script>

<style scoped>
    .loader{
        margin-top: 40px;
        text-align: center;
    }

</style>
