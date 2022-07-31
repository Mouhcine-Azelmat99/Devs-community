<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Save;
use Illuminate\Support\Facades\Auth;
use LanguageDetector\LanguageDetector;


class HomeController extends Controller
{
    public function index(){
        // session()->put('isDark', true);
        // dd(session('isDark'));
        $user_id=Auth::id();
        $categories=Category::all();
        return view('home',compact('user_id','categories'));
    }

    public function switchModes($mode)
    {
        // if($mode==='light'){
        //     session()->put('isDark', false);
        // }else{
        //     session()->put('isDark', true);
        // }
        return response()->json(session('isDark'));
    }
    public function changeMode()
    {
        if (session()->has('isDark')) {
            session()->put('isDark', !session('isDark'));
        }
        else {
            //provide an initial value of isDark
            session()->put('isDark', true);
        }
        return redirect()->back();
    }

    public function profile()
    {
        $user_id=Auth::id();
        return view('profile',compact('user_id'));
    }

    public function profilInfo($user_id)
    {
        $user=User::find($user_id);
        $letters=explode(' ',$user->username);
        $letters[0]=$letters[0][0];
        $letters[1]=$letters[1][0];
        $letters=implode($letters);
        $data['letters']=$letters;
        $data['user']=$user;
        return response()->json($data);
    }
}
