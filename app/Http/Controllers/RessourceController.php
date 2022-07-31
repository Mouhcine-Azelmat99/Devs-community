<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ressource;


class RessourceController extends Controller
{
    public function index()
    {
        return view('ressources');
    }

    public function getRessources()
    {
        $ressources=Ressource::all();
        return response()->json($ressources);
    }
}
