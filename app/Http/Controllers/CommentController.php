<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment=Comment::create([
            'user_id' => $request->user_id,
            'post_id' => $request->post_id,
            'content' => $request->content,
        ]);
        if($comment){
            $data=[
                'status'=>"success",
                'message'=>"Comment has been added"
            ];
        }
        else{
            $data=[
                'status'=>"danger",
                'message'=>"Error can't add this comment"
            ];
        }
        return response()->json($data);
    }

    public function getCommentByPost($id)
    {
        $comment=Comment::where('post_id','=',$id)
                ->join('posts','comments.post_id','=', 'posts.id')
                ->join('users','comments.user_id','=', 'users.id')
                ->get(['comments.*','users.username']);

        return response()->json($comment);
    }
}
