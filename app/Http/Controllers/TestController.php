<?php


namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Tree;

class TestController extends Controller
{

    /**
     * Дерево
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function tree()
    {
        /*$tree1 = Tree::with('children_tree.children_tree.children_tree')->where('parent_id', 0)->get();*/
        $tree = Tree::get();
        $treeArr = [];

        foreach ($tree as $key => $item){
            $treeArr[$item['parent_id']][$item['id']] = $item;
        }

        $parentArr = $treeArr[0];

        $trees = $this->generateTree($parentArr, $treeArr);


        return response()->json(['tree' => $trees],200);
    }


    /**
     * формирование дерева
     *
     * @param $parentArr
     * @param $treeArr
     * @return mixed
     */
    public function generateTree($parentArr, $treeArr)
    {
        foreach ($parentArr as $key => $item){
            if (!isset($item['children'])){
                $parentArr[$key]['children'] = [];
            }

            if (array_key_exists($key, $treeArr)){
                $parentArr[$key]['children'] = $treeArr[$key];
                $this->generateTree($parentArr[$key]['children'], $treeArr);
            }
        }

        return $parentArr;
    }


}
