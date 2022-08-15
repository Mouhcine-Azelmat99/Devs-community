<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;


class SettingController extends Controller
{
    public function changeLangue(Request $request)
    {
        $user_id=Auth::id();
        $setting=Setting::where('user_id',$user_id);
        if ($setting->count()>0) {
            $setting->update([
                'langue'=>$request->langue
            ]);
        }else {
            $setting=Setting::create([
                'user_id' => $user_id,
                'langue' => $request->langue,
            ]);
        }
        return redirect()->back();
    }
    public function changeTheme(Request $request)
    {
        $user_id=Auth::id();
        $setting=Setting::where('user_id',$user_id);
        if ($setting->count()>0) {
            $setting->update([
                'theme'=>$request->theme
            ]);
        }else {
            $setting=Setting::create([
                'user_id' => $user_id,
                'theme' => $request->theme,
            ]);
        }
        return redirect()->back();
    }
}
