<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Records\Comment;

class CommentsController extends Controller
{

    public function commentManagementPage()
    {
        $all_comments = Comment::latest()->get();
        $all_comments->all_count = Comment::all()->count();
        $all_comments->month_count = Comment::thisMonth()->get()->count();
        $all_comments->today_count = Comment::today()->get()->count();
        $all_comments->unverified_count = Comment::unverified()->get()->count();
        return view('cpanel.pages.comments.comments_management', compact('all_comments'));
    }

    public function insertNewComment(CommentRequest $req)
    {
        $it = new \App\Models\Records\Comment;
        $it->name = $req->username;
        $it->email = $req->email;
        $it->content = $req->cm_content;
        $it->ip = $req->getClientIp();
        $it->post_id = $req->post_id;
        if ($req->replier_id != '')
            $it->parent_cm_id = (int)$req->replier_id;
        $it->save();
        return redirect()->back()->with('success', 'با موفقیت درج شد. بعد از تأیید به نمایش در خواهد آمد');
    }

    public function updateComment(UpdateCommentRequest $request, $cm_id){
        $cm = Comment::findOrFail($cm_id);
        foreach($request->all() as $key => $req ){
            $cm->{$key} = $req;
        }
        if ($cm->save())
            return response()->json([
                'code' => 44,
                'status' => 'success',
                'response' => 'Comment updated successfully',
                'text' => 'دیدگاه با موفقیت ذخیره شده'
            ]);
        return response()->json([
            'code' => 40,
            'status' => 'failure',
            'response' => 'Request not acceptable',
            'text' => 'درخواست ارسالی قابل پردازش نیست'
        ]);
    }

    public function verifyComment(Request $request, $cm_id){
        if( $request->ajax() ){
            $cm = Comment::findOrFail( $cm_id );
            $cm->verified= 1;
            $cm->verified_at = Carbon::now();
            $cm->save();
            return $cm;
        }else{
            return back()->with([
                'code' => 40,
                'status' => 'failure',
                'response' => 'Request not acceptable',
                'text' => 'درخواست ارسالی قابل پردازش نیست'
            ]);
        }
    }

    public function deleteComment(Request $request, $cm_id){
        if( $request->ajax() ){
            $cm = Comment::findOrFail( $cm_id );
            $cm->delete();
            return response()->json([
                'code' => 41,
                'status' => 'success',
                'response' => 'Comment is deleted successfully',
                'text' => 'دیدگاه با موفقیت حذف گردید'
            ]);
        }else{
            return back()->with([
                'code' => 40,
                'status' => 'failure',
                'response' => 'Request not acceptable',
                'text' => 'درخواست ارسالی قابل پردازش نیست'
            ]);
        }
    }

    public function getCommentById(Request $request, $cm_id){
        if( $request->ajax() ){
            $cm = Comment::findOrFail( $cm_id );
            $cm->created__at = toPersianNums( jalali()->forge($cm->created_at->timestamp)->format('%y/%m/%d - H:i:s') );
            return $cm;
        }else{
            return back()->with([
                'code' => 40,
                'status' => 'failure',
                'response' => 'Request not acceptable',
                'text' => 'درخواست ارسالی قابل پردازش نیست'
            ]);
        }

    }
}
