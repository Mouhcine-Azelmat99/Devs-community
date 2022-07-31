<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\DB;



class AdminController extends Controller
{
    public function dashboard(){
        $users=User::take(2);
        return view('admin.dashboard',compact('users'));
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
}
