<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;


class LikeController extends Controller
{
    public function store(Request $request)
    {
        $like=Like::create([
            'user_id' => $request->user_id,
            'post_id' => $request->post_id,
        ]);
        if($like){
            $data=[
                'status'=>"success",
                'message'=>"like has been added"
            ];
        }
        else{
            $data=[
                'status'=>"danger",
                'message'=>"Error can't add this like"
            ];
        }
        return response()->json($data);
    }
}
