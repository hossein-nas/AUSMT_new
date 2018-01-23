<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Fastmenu as FMenu;

class Fastmenu extends Controller
{
    public function FastmenuManagementPage()
    {
        $Fastmenu = $this->getAllFastmenuItem();
        $all_Icons = (new Files\FilesCategoryController)->getAllFilesInCat('fastmenu_icons');
        return view('cpanel.pages.fastmenu.fastmenu_management', compact(['Fastmenu','all_Icons']));
    }

    public function addFastmenuItem(Request $req){
        $it = new FMenu;
        $it->title = $req->fastmenu_title;
        $it->uri = $req->fastmenu_url;
        $it->lang_id = $req->lang_id;
        $it->svg_icon_id = $req->icon_id;
        $prev_tmp = ($req->after_of != '') ?$req->after_of : null;
        $it->prev = null;
//        dd($it, $prev_tmp);
        if ($it->save()) {
            if ($this->updateNextItem($it->id, $prev_tmp)) {
                $it->prev = $prev_tmp;
                $it->save();
                return redirect()->back()->with('status', 'با موفقیت افزوده شد');
            }
        }
        return redirect()->back()->with('status', 'مشکلی در ثبت بوجود آمد');
    }

    public function deleteFastmenuItem(Request $req)
    {
        $arr = $req->fastmenu_ids;
        if ($this->deleteItems($arr))
            return redirect()->back()->with('status', 'با موفقیت حذف شدند');
        else
            return redirect()->back()->with('status', 'مشکلی در حذف موارد انتخابی بوجود آمد');

    }


    public function getAllFastmenuItem()
    {
        $it = FMenu::where('prev', null)->get()->first();
        if ( !$it)
            return collect();
        $ret = collect([$it]);
        while ($tmp = $this->getNextItem($it)) {
            $ret->push($tmp);
            $it = $tmp;
        }
        return $ret;
    }

    private function getNextItem($el)
    {
        $next = $el->next;
        if (count($next))
            return $next;
        return false;
    }

    private function deleteItems($arr)
    {
        $all = collect();
        foreach($arr as $in){
            $it = FMenu::find($in);
            $all->push($it);
        }
        if ( $all->count() == 0)
            return false;
        $nextPlusOne = $all->last()->next ;
        $prev = $all->first()->prev;
        $all->each(function($it,$in){
            echo $it->update(['prev' => null]);
        });
        if ($nextPlusOne){
            $nextPlusOne->prev = $prev;
            $nextPlusOne->save();
        }
        $all->each(function($it,$in){
            echo $it->delete();
        });
        return true;
    }

    private function updateNextItem($new,$old){
        $it = FMenu::where('prev',$old)->get()->first();
        if($it){
            if ($it->id != $new) {
                $it->prev = $new;
                if ($it->save())
                    return true;
            }
            return false;
        }
        return true;
    }
}
