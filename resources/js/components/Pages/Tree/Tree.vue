<template>
    <div class="tree" >
        <div class="container">
            <div class="row">
                <item-tree
                    :nodes = "treeData2"
                />
            </div>
        </div>
    </div>
</template>

<script>
import ItemTree from "./item-tree";
export default {
    name: "Tree",
    components: {ItemTree},
    data: () => ({
        /*treeData1: [
            {   name: "Дерево",
                children: [
                    {  name: "Второй уровень вложенности",
                       children: [
                           { name: "Третий уровень вложенности" }
                       ]
                    }
                ]
            },
            {name: "Дерево Дерево", children: [
                {   name: "Второй уровень вложенности 2",
                    children: [
                        { name: "Третий уровень вложенности" }
                    ]
                }]
            },
            {name: "Ти Путин"},
            {name: "Нет ти путин", children: [
                {   name: "Второй уровень вложенности 3",
                    children: [
                        {   name: "Третий уровень вложенности",
                            children: [
                                { name: "Четвертый уровень вложенности" }
                            ]
                        }
                    ]
                }]
            },
        ],*/
        treeData2: []

    }),
    methods: {
        loadTreeData(){
            axios({
                method: 'get',
                url: `/api/tree`,
            })
                .then( (response) => {
                    this.treeData2 =  response.data.tree
                })
                .catch( (err) => {
                    console.log(err)
                })
        }

    },
    mounted() {
        this.loadTreeData()
    }

}
</script>

<style scoped>
    .row{
        margin-left: 200px;
    }
    .children{
        margin-left: 40px;
    }

</style>
