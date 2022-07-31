<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories=Category::all();
        return view('admin.categories',compact('categories'));
    }
    public function store(Request $request){
        $cat=Category::create([
            'name'=>$request->name,
        ]);
        return redirect('admin/categories')->with('msg', 'Category has been added successfully');
    }
    public function delete($id){
        $cat=Category::find($id);
        $cat->delete();
        return redirect('admin/categories')->with('msg', 'Category has been Deleted successfully');
    }

    public function getCategories(){
        $categories=Category::all();
        return response()->json($categories);
    }
}
