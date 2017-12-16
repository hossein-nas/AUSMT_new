<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CommentsController extends Controller
{
    public function insertNewComment(Request $req){
        $it = new \App\Models\Records\Comment;
        $it->name = $req->username;
        $it->email = $req->email;
        $it->content = $req->cm_content;
        $it->ip = $req->getClientIp();
        $it->post_id = $req->post_id;
        if($req->replier_id != '')
            $it->parent_cm_id = (int) $req->replier_id;
        $it->save();
        return redirect()->back()->with('success', 'با موفقیت درج شد. بعد از تأیید به نمایش در خواهد آمد');


    }
}
