<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Post;
use App\Models\Question;
use App\Models\Ressource;
use App\Models\Source;
use Illuminate\Support\Facades\DB;



class AdminController extends Controller
{
    public function dashboard(){
        $posts=Post::orderBy('id', 'DESC')->limit(5)->get();
        $usercount=User::all()->count();
        $postcount=Post::all()->count();
        $questioncount=Question::all()->count();
        $ressourcecount=Ressource::all()->count();
        $data = [
            'usercount'=>$usercount,
            'postcount'=>$postcount,
            'ressourcecount'=>$ressourcecount,
            'questioncount'=>$questioncount,
            'posts'=>$posts,
        ];
        return view('admin.dashboard',compact('data'));
    }
    public function getUsers(){
        $users=User::all();
        return view('admin.users',compact('users'));
    }
    public function setAdmin($id){
        $user = DB::table('users')
              ->where('id', $id)
              ->update(['isAdmin' => true]);
        return redirect('admin/dashboard')->with('msg', 'user has been admin');
    }

    public function deleteQuestion($id)
    {
        $question=Question::find($id)->delete();
        return redirect('admin/questions')->with('msg', 'question has been deleted successfully');
    }
    public function questions()
    {
        $questions=Question::All();
        return view('admin.questions',compact('questions'));
    }

    public function ressources()
    {
        $ressources=Ressource::All();
        $sources=Source::orderBy('ressource_id')->get();
        return view('admin.ressources',compact('ressources','sources'));
    }
    public function deleteSources($id)
    {
        $Source=Source::find($id)->delete();
        return redirect('admin/ressources')->with('msg', 'Source has been deleted successfully');
    }
    public function deleteRessources($id)
    {
        $ressource=Ressource::find($id)->delete();
        return redirect('admin/ressources')->with('msg', 'Ressource has been deleted successfully');
    }

}
