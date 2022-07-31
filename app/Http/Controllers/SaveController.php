<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Save;
use Illuminate\Support\Facades\Auth;
use LanguageDetector\LanguageDetector;

class SaveController extends Controller
{
    public function index(){
        $user_id=Auth::id();
        return view('posts.saved',compact('user_id'));
    }

    public function getSavedByUser($user_id)
    {
        $saved_posts=Save::where('saves.user_id','=',$user_id)
        ->join('posts','saves.post_id','=', 'posts.id')
        ->get(['posts.*']);

    foreach($saved_posts as  $post){
        $post->lg="fr";
        if(isset($post->content)){
            $lg = LanguageDetector::detect($post->content);
        }
        $post->lg=(string)$lg;
    }
    return response()->json($saved_posts);
    }

    public function store(Request $request)
    {
        $savedPost=Save::create([
            'user_id' => $request->user_id,
            'post_id' => $request->post_id,
        ]);
        if($savedPost){
            $data=[
                'status'=>"success",
                'message'=>"Post has been saved"
            ];
        }
        else{
            $data=[
                'status'=>"danger",
                'message'=>"Error can't save this Post"
            ];
        }
        return response()->json($data);
    }
    public function getSavedPosts($user_id){
        $posts=Save::where('saves.user_id','=',$user_id)
            ->join('posts','saves.post_id','=', 'posts.id')
            ->join('users','posts.user_id','=', 'users.id')
            ->get(['posts.*','users.username']);

        foreach($posts as $post){
            $post->lg="fr";
            if(isset($post->content)){
                $lg = LanguageDetector::detect($post->content);
            }
            $post->lg=(string)$lg;
        }
        return response()->json($posts);
    }
    public function delete($id)
    {
        $post=Save::where('post_id',$id);
        $post->delete();
        if($post){
            $data=[
                'status'=>"success",
                'message'=>"post has been deleted"
            ];
        }
        else{
            $data=[
                'status'=>"danger",
                'message'=>"Error can't delete this post"
            ];
        }
        return response()->json($data);
    }

}
