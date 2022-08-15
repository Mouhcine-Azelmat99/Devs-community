<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ressource;
use App\Models\Setting;

class RessourceController extends Controller
{
    public function index()
    {
        $user_id=Auth::id();
        $setting=Setting::where('user_id',$user_id)->first();
        if($setting){
            $langue=$setting->langue;
            $theme=$setting->theme;
        }else{
            $theme=false;
            $langue='an';
        }
        return view('ressources',compact('user_id','langue'));
    }

    public function getRessources()
    {
        $ressources=Ressource::all();
        return response()->json($ressources);
    }


}
