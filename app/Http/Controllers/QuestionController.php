<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Solution;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use LanguageDetector\LanguageDetector;
use Nette\Utils\Image;
use App\Models\Setting;


class QuestionController extends Controller
{
    public function index()
    {
        $user_id=Auth::id();
        $setting=Setting::where('user_id',$user_id)->first();
        if($setting){
            $langue=$setting->langue;
            $dark_theme=$setting->dark_theme;
        }else{
            $dark_theme=false;
            $langue='an';
        }
        return view('questions.questions',compact('user_id','langue','dark_theme'));
    }

    public function getQuestions()
    {
        $questions=Question::join('users','questions.user_id','=', 'users.id')
            ->orderBy('id', 'DESC')
            ->get(['questions.*','users.username']);
        foreach($questions as $question){
            $question->lg="fr";
            if(isset($question->content)){
                $lg = LanguageDetector::detect($question->content);
            }else{
                $lg = LanguageDetector::detect($question->title);
            }
            $question->lg=(string)$lg;
            $solutions=Solution::where('question_id',$question->id)
                ->orderBy('id', 'DESC')
                ->join('users','solutions.user_id','=', 'users.id')
                ->get(['solutions.*','users.username']);
            foreach($solutions as $solution){
                $solution->lg="fr";
                if(isset($solution->content)){
                    $lg = LanguageDetector::detect($solution->content);
                    $solution->lg=(string)$lg;
                }
            }
            $question->solutions=$solutions;
        }
        return response()->json($questions);
    }
    public function showQuestion($slug)
    {
        $user_id=Auth::id();
        $setting=Setting::where('user_id',$user_id)->first();
        if($setting){
            $langue=$setting->langue;
            $dark_theme=$setting->dark_theme;
        }else{
            $dark_theme=false;
            $langue='an';
        }
        return view('questions.showQuestion',compact('slug','user_id','langue','dark_theme'));
    }
    public function show($slug)
    {
        $question=Question::where('slug',$slug)
            ->join('users','questions.user_id','=', 'users.id')
            ->orderBy('id', 'DESC')
            ->first(['questions.*','users.username']);
            $question->lg="fr";
            if(isset($question->content)){
                $lg = LanguageDetector::detect($question->content);
            }else{
                $lg = LanguageDetector::detect($question->title);
            }
            $question->lg=(string)$lg;
            $solutions=Solution::where('question_id',$question->id)
                ->orderBy('id', 'DESC')
                ->join('users','solutions.user_id','=', 'users.id')
                ->get(['solutions.*','users.username']);
            foreach($solutions as $solution){
                $solution->lg="fr";
                if(isset($solution->content)){
                    $lg = LanguageDetector::detect($solution->content);
                    $solution->lg=(string)$lg;
                }
            }
            $question->solutions=$solutions;

        return response()->json($question);
    }

    public function storeSolution(Request $request)
    {
         $solution = new Solution;
         if($request->content) {
             $solution->content=$request->content;
         }
         $solution->question_id=$request->question_id;
         $solution->user_id=$request->user_id;
         if(empty($request->file)) {
            $img_name = time().'.'.$request->file->extension();
            $request->file->move(public_path('images'),$img_name);
            $solution->img = $img_name;
        }
        $solution->save();
        if($solution){
            $data=[
                'status'=>"success",
                'message'=>"solution has been added"
            ];
        }
        else{
            $data=[
                'status'=>"danger",
                'message'=>"Error can't add this solution"
            ];
        }
        return response()->json($data);
    }
    public function storeQuestion(Request $request)
    {
         $question = new Question;
         if($request->body) {
             $question->body=$request->body;
         }
         $question->title=$request->title;
         $question->user_id=$request->user_id;
         if(isset($request->file)) {
            $img_name = time().'.'.$request->file->extension();
            $request->file->move(public_path('images'),$img_name);
            $question->img = $img_name;
        }
        $slug=Str::slug($request->title,'-');
        $question->slug=$slug;
        $question->save();
        if($question){
            $data=[
                'status'=>"success",
                'message'=>"question has been added"
            ];
        }
        else{
            $data=[
                'status'=>"danger",
                'message'=>"Error can't add this question"
            ];
        }
        return response()->json($data);
    }

    public function deleteSolution($id)
    {
        $solution=Solution::find($id);
        $solution->delete();
        if($solution){
            $data=[
                'status'=>"success",
                'message'=>"solution has been deleted"
            ];
        }
        else{
            $data=[
                'status'=>"danger",
                'message'=>"Error can't delete this solution"
            ];
        }
        return response()->json($data);
    }
    public function deleteQuestion($id)
    {
        $question=Question::find($id);
        $question->delete();
        if($question){
            $data=[
                'status'=>"success",
                'message'=>"question has been deleted"
            ];
        }
        else{
            $data=[
                'status'=>"danger",
                'message'=>"Error can't delete this question"
            ];
        }
        return response()->json($data);
    }
}
