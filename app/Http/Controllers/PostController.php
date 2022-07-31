<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Save;
use Nette\Utils\Image;

use LanguageDetector\LanguageDetector;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::all();
        $categories=Category::all();
        return view('admin.posts',compact('posts','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $user_id=Auth::id();
        $categories=Category::all();
        return view('posts.showPost',compact('slug','user_id','categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::find($id);
        $post->delete();
        return redirect()->back()->with('msg', 'posts has been deleted successfully');
    }

    public function getPosts($user_id){
        $posts=Post::join('users','posts.user_id','=', 'users.id')
            ->orderBy('id', 'DESC')
            ->get(['posts.*','users.username']);
        $likes=Like::all();
        $savedPost=Save::all();
        // $user_id=Auth::id();
        foreach($posts as $post){
            $post->liked=false;
            $post->saved=false;
            $post->likes=$likes->where('post_id', $post->id)->count();
            if (($likes->contains('post_id', $post->id)) && ($likes->contains('user_id',$user_id))){
                $post->liked=true;
            }
            if (($savedPost->contains('post_id', $post->id)) && ($savedPost->contains('user_id',$user_id))){
                $post->saved=true;
            }
            $post->lg="fr";
            if(isset($post->content)){
               $lgPost = LanguageDetector::detect($post->content);
            }else{
                $lgPost = LanguageDetector::detect($post->title);
            }
            $post->lg=(string)$lgPost;
            $comments=Comment::where('post_id',$post->id)
                ->join('users','comments.user_id','=', 'users.id')
                ->get(['comments.*','users.username']);
            foreach($comments as $comment){
                $comment->lg="fr";
                $lg = LanguageDetector::detect($comment->content);
                $comment->lg=(string)$lg;
            }
            $post->comments=$comments;
            }
        return response()->json($posts);
    }

    public function postsByCat($category)
    {
        $user_id=Auth::id();
        $category=Category::where('name',$category)->first();
        $category_id=$category->id;
        return view('posts.postsCategories',compact('category_id','user_id'));
    }

    public function getPostsByCategory($category_id,$user_id){
        $posts=Post::where('category_id',$category_id)
            ->join('users','posts.user_id','=', 'users.id')
            ->orderBy('id', 'DESC')
            ->get(['posts.*','users.username']);
        $likes=Like::all();
        $savedPost=Save::all();
        // $user_id=Auth::id();
        foreach($posts as $post){
            $post->liked=false;
            $post->saved=false;
            $post->likes=$likes->where('post_id', $post->id)->count();
            if (($likes->contains('post_id', $post->id)) && ($likes->contains('user_id',$user_id))){
                $post->liked=true;
            }
            if (($savedPost->contains('post_id', $post->id)) && ($savedPost->contains('user_id',$user_id))){
                $post->saved=true;
            }
            $post->lg="fr";
            if(isset($post->content)){
               $lgPost = LanguageDetector::detect($post->content);
            }else{
                $lgPost = LanguageDetector::detect($post->title);
            }
            $post->lg=(string)$lgPost;
            $comments=Comment::where('post_id',$post->id)
                ->join('users','comments.user_id','=', 'users.id')
                ->get(['comments.*','users.username']);
            foreach($comments as $comment){
                $comment->lg="fr";
                $lg = LanguageDetector::detect($comment->content);
                $comment->lg=(string)$lg;
            }
            $post->comments=$comments;
            }
        return response()->json($posts);
    }

    public function showPost($slug,$user_id){
        $post=Post::where('slug',$slug)
            ->join('users','posts.user_id','=', 'users.id')
            ->orderBy('id', 'DESC')
            ->first(['posts.*','users.username']);
        $likes=Like::all();
        $savedPost=Save::all();
        $post->liked=false;
        $post->saved=false;
        $post->likes=$likes->where('post_id', $post->id)->count();
        if (($likes->contains('post_id', $post->id)) && ($likes->contains('user_id',$user_id))){
            $post->liked=true;
        }
        if (($savedPost->contains('post_id', $post->id)) && ($savedPost->contains('user_id',$user_id))){
            $post->saved=true;
        }
        $post->lg="fr";
        if(isset($post->content)){
            $lg = LanguageDetector::detect($post->content);
        }else{
            $lg = LanguageDetector::detect($post->title);
        }
        $post->lg=(string)$lg;
        $comments=Comment::where('post_id',$post->id)
            ->join('users','comments.user_id','=', 'users.id')
            ->get(['comments.*','users.username']);
        foreach($comments as $comment){
            if(isset($post->content)){
                $comment->lg="fr";
                $lg = LanguageDetector::detect($comment->content);
                $comment->lg=(string)$lg;
            }
        }
        $post->comments=$comments;
        return ($post);
    }

    public function addPost(Request $request)
    {
        $post = new Post;
        $post->title=$request->title;
        if(isset($request->newCategory)){
            $category=Category::create([
                'name'=>$request->newCategory,
            ]);
            $post->category_id=$category->id;
        }else{
            $post->category_id=$request->category_id;
        }
        if(isset($request->file)){
            $img_name = time().'.'.$request->file->extension();
            $request->file->move(public_path('images'),$img_name);
            $post->img=$img_name;
        }
        if(isset($request->content)){
            $post->content=$request->content;
        }
        if(isset($request->tag)){
            $post->cat=$request->tag;
        }

        $slug=Str::slug($request->title,'-');
        $post->slug=$slug;
        $post->user_id=$request->user_id;
        $post->save();
        if($post){
            $data=[
                'status'=>"success",
                'message'=>"post has been added"
            ];
        }
        else{
            $data=[
                'status'=>"danger",
                'message'=>"Error can't add this post"
            ];
        }
        return response()->json($data);
    }

    public function relatedPosts()
    {
        $posts=Post::orderBy('created_at','DESC')
            ->limit(4)
            ->get();
        foreach($posts as $post){
            $post->lg="fr";
            if(isset($post->content)){
                $lg = LanguageDetector::detect($post->content);
            }else{
                $lg = LanguageDetector::detect($post->title);
            }
            $post->lg=(string)$lg;
        }
        return response()->json($posts);
    }

    public function search()
    {
        $posts=Post::orderBy('created_at','DESC')->get(['title','slug','content','img']);
        foreach($posts as $post){
            $post->lg="fr";
            if(isset($post->content)){
                $lg = LanguageDetector::detect($post->content);
            }else{
                $lg = LanguageDetector::detect($post->title);
            }
            $post->lg=(string)$lg;
        }
        return response()->json($posts);
    }

    public function deletePost($id)
    {
        $post=Post::find($id);
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

    public function PubliedPost($user_id)
    {
        $publied=Post::where('user_id',$user_id)->get();
        foreach($publied as $post){
            $post->lg="fr";
            if(isset($post->content)){
                $lg = LanguageDetector::detect($post->content);
            }else{
                $lg = LanguageDetector::detect($post->title);

            }
            $post->lg=(string)$lg;
        }
        return response()->json($publied);
    }
}
