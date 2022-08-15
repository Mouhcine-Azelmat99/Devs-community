<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ressource;
use App\Models\Source;

class SourceController extends Controller
{

    public function getSources()
    {
        $ressources=Ressource::all();
        foreach($ressources as $ressource)
        {
            $ressource->sources=Source::where('sources.ressource_id',$ressource->id)->get();
        }
        return response()->json($ressources);
    }

    public function store(Request $request)
    {
        if(isset($request->ressource_name)){
            $ressource=Ressource::create([
                'name'=>$request->ressource_name
            ]);
            $request->ressource_id=$ressource->id;
        }
        $source=Source::create([
            'title'=>$request->title,
            'user_id'=>$request->user_id,
            'lien_youtub'=>$request->lien2,
            'lien_site'=>$request->lien1,
            'ressource_id'=>$request->ressource_id,
        ]);
        if($source){
            $data=[
                'status'=>"success",
                'message'=>"Source has been saved"
            ];
        }
        else{
            $data=[
                'status'=>"danger",
                'message'=>"Error can't save this Source"
            ];
        }
        return response()->json($data);
    }
}
