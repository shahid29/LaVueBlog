<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function getPosts(){
        $result  = Post::with('user','category')->get();
        return response()->json([
            'result' => $result
        ],200);

    }

    public function savePost(Request $request){
        $strpos = strpos($request->photo,';');
        $strsub = substr($request->photo,'0',$strpos);
        $ex = explode('/',$strsub)[1];
        $name = time().".".$ex;
        $img = Image::make($request->photo)->resize(300, 200);
        $path = public_path()."/uploadimage/";
        $img->save($path.$name);

        $savePost = new Post();
        $savePost->title = $request->title;
        $savePost->description = $request->description;
        $savePost->cat_id = $request->cat_id;
        $savePost->user_id = Auth::user()->id;
        $savePost->photo = $name;
        $savePost->save();
    }

    public function deletePostById($id){
        $deletePostById= Post::find($id);
        $photo_path = public_path()."/uploadimage/";
        $db_path = $photo_path.$deletePostById->photo;
            if(file_exists($db_path)){
                unlink($db_path);
            }
        $deletePostById->delete();
    }

    public function EditPostById($id){
        $result = Post::find($id);
        return response()->json([
            'result' => $result
        ],200);
    }

    public function updatePost(Request $request,$id){
        $result = Post::find($id);
        $this->validate($request,[
            'title' =>'required|min:2|max:100',
            'description' =>'required|min:2|max:10000',
            'photo' =>'required',
        ]);

        if ($request->photo != $result->photo){
            $strpos = strpos($request->photo,';');
            $strsub = substr($request->photo,'0',$strpos);
            $ex = explode('/',$strsub)[1];
            $name = time().".".$ex;
            $img = Image::make($request->photo)->resize(300, 200);
            $path = public_path()."/uploadimage/";
            $image = $path.$result->photo;
            $img->save($path.$name);
            if(file_exists($image)){
                unlink($image);
            }

        }else{
            $name=$result->photo;
        }

        $result->title = $request->title;
        $result->description = $request->description;
        $result->cat_id = $request->cat_id;
        $result->user_id = Auth::user()->id;
        $result->photo = $name;
        $result->save();
    }

    public function deletPostBycheckbox($id){
        $SeperateComa = explode(',',$id);
        foreach ($SeperateComa as $Id){
            $deletePostById= Post::find($Id);
            $photo_path = public_path()."/uploadimage/";
            $db_path = $photo_path.$deletePostById->photo;
            if(file_exists($db_path)){
                unlink($db_path);
            }
            $deletePostById->delete();

        }
    }
}
