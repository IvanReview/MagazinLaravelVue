<template>
    <div>
        <div class="item-tree" v-for="node in nodes">
            <h4>{{node.name}}</h4>
            <div class="children">
                <item-tree
                    :nodes="node.children"
                />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "item-tree",
    props: {
        nodes: {},
        indent: {
            type: Number,
            default: 0
        }
    }
}
</script>

<style scoped>
    .children {
        margin-left: 100px;
    }

</style>
