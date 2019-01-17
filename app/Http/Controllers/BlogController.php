<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\User;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function getAllBlogPost(){
        $result = Post::with('user','category')->orderBy('id','desc')->get();

        return response()->json([
            'result'=>$result
        ],200);
    }

    public function singlePostById($id){
        $result = Post::with('user','category')->where('id',$id)->first();

        return response()->json([
            'result'=>$result
        ],200);
    }

    public function categoryForSidebar(){
        $result = Category::all();

        return response()->json([
            'result'=>$result
        ],200);
    }
    public function allpostbyCategoryId($id){
        $result = Post::with('user','category')->where('cat_id',$id)->get();

        return response()->json([
            'result'=>$result
        ],200);
    }
    public function latest(){
        $result = Post::with('user','category')->orderBy('id','desc')->get();

        return response()->json([
            'result'=>$result
        ],200);
    }

    public function searchpost(){
        $search = \Request::get('s');
        if ($search!=null){
            $result = Post::with('user','category')
                ->where('title','LIKE',"%$search%")
                ->orWhere('description','LIKE',"%$search%")
                ->get();

            return response()->json([
                'result'=>$result
            ]);
        }else{
          return $this->getAllBlogPost();
        }

    }
}
