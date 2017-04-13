<?php

namespace App\Http\Controllers;

use App\Post;
use App\Incoming_event as Incoming;
use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function about(){
        $name = "Hossein Nasiri";
        return view('pages.about',["first"=>"Hossein","last"=>"Nasiri"]);
    }

    // post
    public function post($hifen) {
        $post = Post::post($hifen);
        $post->increase;
        return view('pages.postview.posts',compact('post'));
    }
    public function page($hifen) {
        $page = Post::page($hifen);
        return view('pages.postview.pages',compact('page'));
    }
    public function notfication($hifen) {
        $notfication = Post::notfication($hifen);
        $notfication->increase;
        return view('pages.postview.notfications',compact('notfication'));
    }
    public function seminar($hifen) {
        $seminar = Post::seminar($hifen);
        $seminar->increase;
        return view('pages.postview.seminars',compact('seminar'));
    }
    public function incoming($hifen) {
        $incoming = Post::incoming($hifen);
        return view('pages.postview.incoming',compact('incoming'));
    }
    public function other($hifen) {
        $other = Post::other($hifen);
        $other->increase;
        return view('pages.postview.others',compact('other'));
    }

}
