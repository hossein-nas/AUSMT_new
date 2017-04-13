<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

use App\Http\Requests;

class CommentsController extends Controller
{
    /**
     *
     */
    public function showAll(){
        $unverified = Comment::unverifiedCm()->get();
        $last10 = Comment::last10()->get();
        return view('cpanel.pages.comments.overviewpages',compact('unverified','last10'));
    }
    public function show($id){
        $cm = Comment::findOrFail($id);
        return view('cpanel.pages.comments.show',compact('cm'));
    }
    public function store(Request $request){
        $rules=[
            'username'      =>  'required|min:3',
            'content'       =>  'required|min:5',
            'post_id'       =>  'required',
            'email'         =>  'email',
        ];
        $messages=[
            'username.required'     =>  'نام و نام خانوادگی خود را وارد نکردید.',
            'username.min'          =>  'نام و نام خانوادگی حداقل باید 3 باشد.',
            'content.required'      =>  'َمحتوایی برای نظر خود وارد نکردید.',
            'content.min'           =>  'در محتوای نظر خود باید حداقل از 3 کاراکتر استفاده نمایید.',
            'post_id.required'      =>  'مشکلی در پر کردن فیلد ها بوجود آمده است.',
            'email.email'           =>  'ایمیلی که وارد کردید صحیح نیست.'
        ];
        $this->validate($request,$rules,$messages);
        Comment::create($request->all());
        return redirect()->back();
    }

    public function update(Request $request){
        $rules=[
            'post_id'       =>  'required',
	        'content'       =>  'required|min:5',
        ];
        $messages=[
            'content.required'      =>  'َمحتوایی برای نظر خود وارد نکردید.',
            'content.min'           =>  'در محتوای نظر خود باید حداقل از 3 کاراکتر استفاده نمایید.',
            'post_id.required'      =>  'مشکلی در پر کردن فیلد ها بوجود آمده است.',
        ];
        $this->validate($request,$rules,$messages);
        Comment::findOrFail($request['post_id'])->update(['content'=>$request['content']]);
        return redirect()->route('allComments');
    }

    public function verify($id){
    	Comment::findOrFail($id)->update(['verified'=>1]);
	    return back();
    }
    public function delete($id){
    	Comment::findOrFail($id)->delete();
	    Comment::where('parent_id',$id)->delete();
	    return redirect()->route('allComments');
    }
    public function edit($id){
    	$cm = Comment::findOrFail($id);
	    return view('cpanel.pages.comments.editcomment',compact('cm'));
    }
}
