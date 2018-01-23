<?php

namespace App\Http\Controllers\Records;

use App\Models\Files\File_Type;
use App\Models\Records\Tag;
use App\Models\Slider;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Records\Record;
use App\Models\Records\Post;
use App\Models\Records\Record_Type;

class RecordsController extends Controller
{
    public function showNewPost(){
        $all_tags = Tag::all();
        return view('cpanel.pages.records.posts.news.newNews',compact('all_tags'));
    }

    public function storeRecord(Request $request,$type){
        $request->request->add(['title_seo' => $this->makeSeoURL( $request->title )] );
        $request->request->add(['user_id' => 1] );
        $request->request->add(['record_type_id' => $this->getFileTypeIDByName($type) ] );
        $this->storeTags($request->tags);
        $ret = Record::create($request->all());
        $post = $this->storeNewPost($request,$ret->id);
        $ret->post->tags()->sync($this->getIdsByName($request->tags));
        if( $request->has('add_slider') ){
            $this->addToSlider($ret);
        }
        return redirect()->route('cpanel');
    }

    public function getLatestNews(){
        $res = Records::latestNews()->get();
        return $res;
    }

    /* ...Private Methods... */

    private function storeNewPost($request,$id){
        $request->request->add(['id' => $id] );
        if( !$request->has('is_important') ){
            $request->request->add(['is_important' => 0] );
        }
        return Post::create($request->all());
    }
    private function makeSeoURL($text){
        $newText = trim($text);
        $newText = str_replace(" ","-",$newText);
        return $newText;
    }

    private function getFileTypeIDByName($name){
        return Record_Type::where('name',$name)->get()->first()->id;
    }

    private function storeTags($tags){
        $tags_collection = collect($tags);
        $all_tags = Tag::all()->pluck('name')->toArray();
        $diffs = $tags_collection->diff($all_tags);
        foreach ($diffs as $it){
            Tag::insert(['name'=>$it]);
        }
        return true;
    }
    private function getIdsByName($arr){
        $ret = [];
        if( !is_array($arr))
            return $ret;
        foreach ($arr as $ar){
            $id = Tag::where('name',$ar)->get()->first()->id;
            array_push($ret,$id);
        }
        return array_values($ret);
    }
    private function addToSlider($record){
        $it = new Slider;
        $it->title = $record->title;
        $it->lang_id = $record->lang_id;
        $it->photo_id = $record->thumbnail_id;
        $it->record_id = $record->id;
        $it->description = '';
        $it->save();

    }


}
