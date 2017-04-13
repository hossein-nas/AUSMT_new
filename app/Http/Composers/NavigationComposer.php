<?php
namespace App\Http\Composers;

use App\Comment;
use App\Incoming_event;
use App\Incoming_event as Incoming;
use App\Navbar;
use App\Post;
use App\Setting;
use Carbon\Carbon;
use Illuminate\View\View;

class NavigationComposer {
    // compose
    public function compose($view) {
        $view->with('fast_links', Setting::where('set_type',1)->get());
        $view->with('links', Setting::where('set_type',2)->get());
    }

    // navbar
    public function navbar($view) {
        $Navs= Navbar::where('parent_id',0)->get()->toArray();
        for($i=0 ; $i<count($Navs);$i++) {
            $childNav = Navbar::where('parent_id', $Navs[$i]['id'])->get()->toArray();
            $Navs[$i]['childs'] = $childNav;
            for ($j = 0; $j < count($childNav); $j++) {
                $subChildNav = Navbar::where('parent_id', $childNav[$j]['id'])->get()->toArray();
                $Navs[$i]['childs'][$j]['childs'] = $subChildNav;
            }
        }
        $view->with('navbar',$Navs );
    }

    // slider
    public function slider($view) {
        $SliderItems= Post::where('addToSlider',1)->latest()->limit(10)->get();
        $view->with('Items',$SliderItems );
    }
    // homepage
    public function homepage($view) {
        $arr = [
            'hot_news'      => Post::hotPosts()->get(),
            'posts'         => Post::allPost(true)->get(),
            'notfications'  => Post::allNotfication(true)->get(),
            'seminars'      => Post::allSeminar(true)->get(),
            'others'        => Post::allOther(true)->get(),
            'incomings'     => Post::allIncoming(true)->get(),
        ];
        $view->with($arr);
    }

    // post
    public function post($view) {
        $arr = [
            'hot_news'      => Post::hotPosts()->get(),
        ];
        $view->with($arr);
    }
    public function fastmenu($view) {
	    $f_menu = getFastMenuItems();
	    ksort($f_menu);
	    $view->with('f_menu',$f_menu);
    }
    public function unverifiedCommentsCount($view) {
	    $unverifiedCommentsCount = Comment::unverifiedCm()->get()->count();
	    $unverifiedCommentsCount = toPersianNums($unverifiedCommentsCount);
	    $view->with('unverifiedCommentsCount',$unverifiedCommentsCount);
    }
}
