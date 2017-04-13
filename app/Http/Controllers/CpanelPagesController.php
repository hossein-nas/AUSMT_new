<?php

namespace App\Http\Controllers;

use App\Navbar;
use App\Professor;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Incoming_event as Incoming;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\jDateTime;

class CpanelPagesController extends Controller
{

	public function __construct()
	{
	}

	public function post($new_post){
		return view("cpanel.pages.new_$new_post");
	}

	public function manageposts(){
		$allPosts['post']           = Post::allPost()->get();
		$allPosts['page']           = Post::allPage()->get();
		$allPosts['notfication']    = Post::allNotfication()->get();
		$allPosts['seminar']        = Post::allSeminar()->get();
		$allPosts['other']          = Post::allOther()->get();
		$allPosts['incoming']       = Post::allIncoming()->get();
		return view('cpanel.pages.manageposts',compact('allPosts'));
	}
	public function store(Request $request){
		$request['user_id']=1;
		$request['hifen_title']=seoUrl($request['title']);

		$rules=[
			'title'                 =>  'required|min:3',
			'hifen_title'           =>  'unique:posts',
			'content'               =>  'required|min:50',
			'image'                 => 'required'
		];
		$messages=[
			'title.required'        =>  'شما باید فیلد عنوان را کامل کنید.',
			'hifen_title.unique'    =>  'شما قبلا یک عنوان با این نام ثبت کرده اید، یک عنوان متمایز انتخاب کنید.',
			'title.min'             =>  'در فیلد عنوان شما میباست حداقل ۳ کاراکتر باید وارد نمایید.',
			'content.required'      =>  'بدون وارد کردن محتوای نمیتوانید خبری را ثبت نمایید.',
			'content.min'           =>  'محتوای یک خبر میباست حداقل ۵۰ کاراکتر باشد.',
			'image.required'        =>  'تصویر شاخص انتخاب نشده است.',
		];

		if($request['post_type_id']==6){
			$request['image'] = 'img/no-thumbnail.svg';

			if(!jDateTime::checkDate($request['year'], $request['month'],$request['day']))
				$request['expired_at']='';
			else{
				$greg=jDateTime::toGregorian($request['year']+1300, $request['month'],$request['day']);
				$request['expired_at']= $greg[0].'-'.$greg[1].'-'.$greg[2].' 23:59:59' ;
			}

			$rules['expired_at']                =  'required|date';
			$messages['expired_at.required']    =  'تاریخ انتشار را باید به درستی وارد نمایید.';
			$messages['expired_at.date']        =  'تاریخ انتشار را باید به درستی وارد نمایید.';
		}

		if($request['post_type_id']==2){
			$request['image'] = 'img/no-thumbnail.svg';
		}
		if(!file_exists(public_path().$request['image']))
			$request['image']='img/no-thumbnail.svg';
		$this->validate($request,$rules,$messages);
		$p = Post::create($request->all());
		return redirect('/admin-panel/manageposts/#'.$p->posttype->name);
	}


	public function update(Request $request){

      $rules=[
			'title'                 =>  'required|min:3',
			'hifen_title'           =>  'unique:posts',
			'content'               =>  'required|min:50',
			'image'                 =>  'required'
	];
	$messages=[
		'title.required'        =>  'شما باید فیلد عنوان را کامل کنید.',
		'hifen_title.unique'    =>  'شما قبلا یک عنوان با این نام ثبت کرده اید، یک عنوان متمایز انتخاب کنید.',
		'title.min'             =>  'در فیلد عنوان شما میباست حداقل ۳ کاراکتر باید وارد نمایید.',
		'content.required'      =>  'بدون وارد کردن محتوای نمیتوانید خبری را ثبت نمایید.',
		'content.min'           =>  'محتوای یک خبر میباست حداقل ۵۰ کاراکتر باشد.',
		'image.required'        =>  'تصویر شاخص انتخاب نشده است.',
	];
		$p = Post::find($request['rel_id']);
        if($p==null)
            return  back()
                    ->withErrors(['مشخصات پستی که قصد ویرایش آن را دارید متناسب نیست!'])
                    ->withInput();
		if($request['post_type_id']==6){
			if(!jDateTime::checkDate($request['year'], $request['month'],$request['day']))
				$request['expired_at']='';
			else{
				$greg=jDateTime::toGregorian($request['year']+1300, $request['month'],$request['day']);
				$request['expired_at']= $greg[0].'-'.$greg[1].'-'.$greg[2].' 23:59:59' ;
				$p->expired_at=$request['expired_at'];
			}
			$rules['expired_at']                =  'required|date';
			$messages['expired_at.required']    =  'تاریخ انتشار را باید به درستی وارد نمایید.';
			$messages['expired_at.date']        =  'تاریخ انتشار را باید به درستی وارد نمایید.';
		}
		if(in_array($request['post_type_id'],[2,6]))
			$request['image'] = '/img/no-thumbnail.svg';
		if(!file_exists(public_path().$request['image']))
			$request['image']='img/no-thumbnail.svg';

		$this->validate($request,$rules,$messages);
        $request['hifen_title']=seoUrl($request['title']);
		$p->title=$request['title'];
		$p->hifen_title=$request['hifen_title'];
		$p->content=$request['content'];
		$p->priority=isset($request['priority'])?1:0;
		$p->addToSlider=isset($request['addToSlider'])?1:0;
		$p->image=$request['image'];
		$p->save();
		return redirect("/admin-panel/manageposts/#".$p->posttype->name);
	}

	public function edit_post($hifen){
		$p = Post::byHifenTitle($hifen)->get()->first();
		return view('cpanel.pages.edit',compact('p'));
	}

	public function professors(){
		$professors= Professor::latest()->get();
		return view('cpanel.pages.professors',compact('professors'));
	}
	public function addprof(){
		return view('cpanel.pages.addprofessor');
	}
	public function editprof($id){
		$prof = Professor::findOrfail($id);
		return view('cpanel.pages.editprofessor',compact('prof'));
	}
	public function storeprof(Request $request){
		$rules=[
			'name'                  => 'required|min:5',
			'email'                 => 'required|email',
			'field'                 => 'required',
			'science_ranking'       => 'required',
			'educational_group'     => 'required',
			'homepage'              => 'required',
		];
		$messages=[
			'name.required'                  => 'نام عضوی که قصد اضافه کردنش را دارید وارد نکردید.',
			'name.min'                       => 'برای نام عضو باید حداقل ۵ کاراکتر وارد نمایید.',
			'email.required'                 => 'فیلد ایمیل را وارد نکردید.',
			'email.email'                    => 'ایمیل ای که وارد کردید ساختار درستی ندارد. تصحیح بفرمایید.',
			'field.required'                 => 'رشته تحصیلی را وارد نکردید.',
			'science_ranking.required'       => 'رتبه علمی را وارد نکردید.',
			'educational_group.required'     => 'گروه آموزشی را وارد نکردید.',
			'homepage.required'              => 'صفحه خانگی را وارد نکردید',
		];
		if(!file_exists(public_path().$request['image']))
			$request['image']='img/no-avatar.svg';
		$this->validate($request,$rules,$messages);
		$p = Professor::create($request->all());
		return redirect('/admin-panel/allprofessors');
	}
	public function updateprof(Request $request){
		$rules=[
			'name'                  => 'required|min:5',
			'email'                 => 'required|email',
			'field'                 => 'required',
			'science_ranking'       => 'required',
			'educational_group'     => 'required',
			'homepage'              => 'required',
			'college'               => 'required',
		];
		$messages=[
			'name.required'                  => 'نام عضوی که قصد اضافه کردنش را دارید وارد نکردید.',
			'name.min'                       => 'برای نام عضو باید حداقل ۵ کاراکتر وارد نمایید.',
			'email.required'                 => 'فیلد ایمیل را وارد نکردید.',
			'email.email'                    => 'ایمیل ای که وارد کردید ساختار درستی ندارد. تصحیح بفرمایید.',
			'field.required'                 => 'رشته تحصیلی را وارد نکردید.',
			'science_ranking.required'       => 'رتبه علمی را وارد نکردید.',
			'educational_group.required'     => 'گروه آموزشی را وارد نکردید.',
			'homepage.required'              => 'صفحه خانگی را وارد نکردید',
			'college.required'               => 'نام دانشکده را وارد نکردید',
		];
		if(!file_exists(public_path().$request['image']))
			$request['image']='/img/no-avatar.svg';
		$this->validate($request,$rules,$messages);
		$prof=Professor::findOrFail($request['rel_id']);
		$prof->name=$request['name'];
		$prof->email=$request['email'];
		$prof->field=$request['field'];
		$prof->science_ranking=$request['science_ranking'];
		$prof->educational_group=$request['educational_group'];
		$prof->image=$request['image'];
		$prof->homepage=$request['homepage'];
		$prof->college=$request['college'];
		$prof->save();
		return redirect('/admin-panel/allprofessors');
	}

	public function navbar(){
		$navs = Navbar::allNavByParent()->get();
		foreach ($navs as $nav):
			$nav->childs = Navbar::allNavByParent($nav->id)->get();
			if($nav->childs->count()):
				for($i=0;$i<$nav->childs->count();$i++):
					$nav->childs[$i]->childs = Navbar::allNavByParent($nav->childs[$i]->id)->get();
				endfor;
			endif;
		endforeach;
		return view('cpanel.pages.navigationbar',compact('navs'));
	}

	public function add_navbar_item(Request $request){
		$rules = [
			'parent_id'             => 'required',
			'name'                  => 'required|min:5',
			'href'                  => 'required',
		];
		$messages = [
			'parent_id.required'             => 'مشکلی در انتخاب جایگاه موردی که قصد اضافه کردن اش را داشتید به وجود آمده.',
			'name.min'                       => 'عنوان حداقل باید 5 کاراکتر باشد.',
			'name.required'                  => 'وارد کردن عنوان الزامیست.',
			'href.required'                  => 'آدرس را وارد نکردید.',
		];
		$this->validate($request,$rules,$messages);
		Navbar::create($request->all());
		return back();
	}
	public function edit_navbar_item(Request $request){
		$nav = Navbar::findOrFail($request['rel_id']);
		$rules = [
			'name'                  => 'required|min:5',
			'href'                  => 'required',
		];
		$messages = [
			'name.min'                       => 'عنوان حداقل باید 5 کاراکتر باشد.',
			'name.required'                  => 'وارد کردن عنوان الزامیست.',
			'href.required'                  => 'آدرس را وارد نکردید.',
		];
		$this->validate($request,$rules,$messages);
		$nav->name = $request['name'];
		$nav->href = $request['href'];
		$nav->save();
		return back();
	}
	public function delete_navbar_item(Request $request){

		$nav[] =Navbar::findOrFail($request['rel_id'])->id;
		foreach (Navbar::allNavByParent($request['rel_id'])->get() as $child){
			$nav[] = $child->id;
			foreach (Navbar::allNavByParent($child->id)->get() as $childs){
				$nav[] = $childs->id;
			}
		}
		foreach ($nav as $id)
			Navbar::findOrFail($id)->delete();
		return back();
	}

}
