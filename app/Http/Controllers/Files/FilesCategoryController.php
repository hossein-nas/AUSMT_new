<?php

namespace App\Http\Controllers\Files;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\Files\File as FFile;
use App\Models\Files\File_Category;
use function GuzzleHttp\Psr7\parse_header;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FilesCategoryController extends Controller
{
    public function deleteCategory(Request $req)
    {
        if ( $this->checkCategoryIsRemovable($req->cat_id) )
            return back()->with(['status' => 'failure', 'text' => 'این دسته قابل حذف نیست'] );
        $it = File_Category::findOrFail($req->cat_id);
        if ($it->delete())
            return back()->with(['status' => 'success', 'text' => 'دسته با موفقیت حذف شد'] );
        return back()->with( ['status' => 'failure', 'text' => 'مشکلی در حذف فایل به وجود آمد!'] );

    }

    public function editCategory(Request $req)
    {
        $it = File_Category::findOrFail($req->cat_id);
        $it->name = $req->category_name;
        $it->description = $req->description;
        if ($it->save()) {
            return back()->with(['status' => 'success', 'text' => 'دسته با موفقیت ویرایش شد.'] );
        }
    }

    public function addNewCategory(Request $req)
    {
        $valid_dir_name = str_replace(" ", "_", trim($req->dir_name));
        $new = new File_Category();
        $new->name = $req->category_name;
        $new->dir_name = $valid_dir_name;
        $new->base_dir_path = $this->getParentBasePath($req->parent_category) . '/' . $valid_dir_name;
        $new->description = $req->description;
        $new->parent_category_id = $req->parent_category;
        $new->removable = $req->has('removable') ? 1 : 0;
        if ($this->createDirInPath($new->base_dir_path)) {
            $new->save();
            return back()->with(['status' => 'success', 'text' => 'دسته با موفقیت افزوده شد' ]);
        } else
            return back()->with(['status' => 'failure', 'text' => 'مشکلی در حذف دسته به وجود آمد' ]);

    }

    public function getAllCategories()
    {
        return [$this->getOrderedCategory()];
    }

    private function getOrderedCategory($id = 1)
    {
        $parent = File_Category::findOrFail($id);
        if ($this->hasChild($id)) {
            $ret = [];
            $res = $this->getCategoryByParentID($id);
            foreach ($res as $r) {
                $ret [] = $this->getOrderedCategory($r->id);
            }
            $parent->childs = $ret;
        }
        return $parent;
    }

    private function getCategoryByParentID($pid)
    {
        $all = File_Category::where('parent_category_id', $pid)->get();
        return $all;
    }

    private function hasChild($id)
    {
        $res = File_Category::where('parent_category_id', $id);
        if ($res)
            return true;
        return false;
    }

    private function getParentBasePath($id)
    {
        return File_Category::where('id', $id)->get()->first()->base_dir_path;
    }

    private function createDirInPath($path)
    {
        return Storage::disk('public')->makeDirectory($path);
    }

    public function getAllFileByDirName($dir_path, $ext)
    {
        dd($dir_path);
        $el = File_Category::where('dir_name', $dir_path)->get()->first();
        $filesss = Storage::disk('public')->files($el->base_dir_path);
        foreach ($filesss as $path) {
            $file = pathinfo($path);
            if ($file['extension'] != $ext)
                continue;
            $file['size'] = File::size($path);
            $file['name'] = File::name($path);
            $files[] = $file;
        }
        return $files;
    }

    public function getCatIdByCatDirName($dir_name)
    {
        $it = File_Category::where('dir_name', $dir_name)->get()->first();
        if (count($it) > 0)
            return $it->id;
        return false;
    }

    public function getAllFilesInCat($cat_name)
    {
        if ($cat_id = $this->getCatIdByCatDirName($cat_name)) {
            return (File_Category::find($cat_id)->files);
        }
        return collect();
    }

    private function checkCategoryIsRemovable($cat_id)
    {
        return File_Category::where('id', $cat_id)->where('removable', 1)->get()->isEmpty();
    }

}
