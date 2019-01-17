<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function save_category(Request $request){

        $category = new Category();
        $this->validate($request,[
            'cat_name'=>'required|min:2|max:20'
        ]);
        $category->cat_name = $request->cat_name;
        $category->save();

}

    public function getCategories(){
        $result = Category::all();
        return response()->json([
            'showResult'=>$result
        ],200);
    }

    public function deleteCategoryById($id){
        $category = Category::find($id);
        $category->delete();
    }

    public function EditCategoryById($id){
//        return $id;
        $result = Category::find($id);
        return response()->json([
            'result' => $result
        ],200);

    }

    public function updateCategoryById(Request $request,$id){
        $category = Category::find($id);
        $this->validate($request,[
            'cat_name' =>'required|min:2|max:20'
        ]);
        $category->cat_name = $request->cat_name;
        $category->save();

    }
    public function deletebyCheckbox($id){
        $sepeartByComa = explode(',',$id);
        foreach ($sepeartByComa as $Id){
            $category = Category::find($Id);
            $category->delete();
        }
    }
}
