<?php

namespace App\Http\Controllers\View\Posts;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Morilog\Jalali\jDate;

class PostsController extends Controller
{
    public function showNews($title){
        $news = \App\Models\Records\Record::where('title_seo',$title)->get()->first();
        $news->date = toPersianNums( jDate::forge($news->created_at->timestamp)->format('%d %Bماه %y') );
        $news->time = toPersianNums( jDate::forge($news->created_at->timestamp)->format('%H:i') );
        $news->comments = $news->post->comments()->where('verified', 1)->latest()->get();
        return view('layouts/posts_layout/news',compact('news'));
    }
}
