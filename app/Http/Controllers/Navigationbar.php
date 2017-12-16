<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Navigationbar as Navbar;

class Navigationbar extends Controller
{
    public function deleteNavItem(Request $req){
        $it = Navbar::findOrFail($req->navbar_id);
        if ($this->deleteItem($it->id)) {
            return redirect()->back()->with('status', 'با موفقیت حذف شد شد');
        }
    }

    public function addNewItem(Request $req){
        $it = new Navbar;
        $it->title = $req->nav_title;
        $it->uri = $req->url;
        $it->lang_id = $req->lang_id;
        $it->navbar_type_id = $req->nav_type;
        $it->parent_id = ($req->parent_nav != '' ) ? (int)$req->parent_nav : NULL;
        $it->prev = (is_numeric( (int) $req->after_of) and $req->after_of != null )? (int) $req->after_of: NULL;
        $hasNext = $this->hasNextItem($it->prev, $it->parent_id);
        if ( $it->save() ) {
            if ($hasNext) $this->updateNextRow($it->prev,$it->id, $it->parent_id);
            return redirect()->back()->with('status', 'با موفقیت افزوده شد');
        }
    }
    public function NavbarManagementPage(){
       $orderedNav =  $this->getOrderedNavItems() ;
        return view('cpanel.pages.navbar.navbar_management', compact('orderedNav'));
    }

    public function getOrderedNavItems($parent_id = null){
        $allRoot = Navbar::where('parent_id', $parent_id)->get();
        $ret = collect();
        $prevId = null;
        foreach ($allRoot as $r){
            $it = Navbar::where('parent_id', $parent_id)->where('prev',$prevId)->get()->first();
            $prevId =$it->id;
            $ret->push($it);
        }
        $root = $ret;
        foreach ($root as $r){
            if ( $this->hasChild($r->id) )
                $r->childs = $this->getOrderedNavItems($r->id);
        }
        return $root;
    }
    private function getAllChildren($id){
        $it =  Navbar::where('id', $id)->get();
        if ( count($it) )
            return $it;
    }
    private function deleteItem($id){
        $it = Navbar::find($id);
        if (count($it->children) > 0) {
            foreach ($it->children as $child)
                $this->deleteItem($child->id);
            $update = Navbar::where('parent_id',$it->id)->update(['prev'=> null]);
            $update = Navbar::where('parent_id',$it->id)->delete();
        }
        Navbar::where('prev', $it->id)->update(['prev'=>$it->prev]);
        if($it->delete())
            return true;
        return false;
    }
    private function hasChild($id){
        $it =  Navbar::where('parent_id', $id)->first();
        if ( count($it) )
            return $it;
        return false;
    }
    private function hasNextItem($prev, $parent_id){
        $it =  Navbar::where('parent_id', $parent_id)->where('prev',$prev)->first();
        if ( count($it) )
            return $it;
        return false;
    }
    private function updateNextRow($oldPrev,$newPrev,$parent_id){
        $ret = Navbar::where('parent_id',$parent_id)->where('prev',$oldPrev)->first();
        $ret->prev=$newPrev;
        if ($ret->save())
            return true;
        return false;
    }
    public function test($parent_id=1){
        $allRoot = Navbar::where('parent_id', $parent_id)->get();
        $ret = collect();
        $prevId = null;
        foreach ($allRoot as $r){
            $it = Navbar::where('parent_id', $parent_id)->where('prev',$prevId)->get()->first();
            $arr = $it->id;
            $prevId =$arr;
            $ret->push($it);
        }
        echo ($this->deleteAllChildren(195));
    }
}
