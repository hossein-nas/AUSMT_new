<?php

namespace App\Models\Records;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'au_comment';
    protected $dates = ['verified_at', 'created_at', 'updated_at'];
    protected $appends = ['postUrl'];
    protected $fillable = [
        'name',
        'email',
        'content',
        'verified',
        'verified_at',
        'is_admin',
        'ip',
        'post_id',
        'parent_cm_id'
    ];

    public function post()
    {
        return $this->belongsTo('App\Models\Records\Post', 'post_id');
    }

    public function replier()
    {
        return $this->belongsTo('App\Models\Records\Comment', 'parent_cm_id');
    }

    public function is_replied()
    {
        return $this->hasMany('App\Models\Records\Comment', 'parent_cm_id');
    }

    public function getPostUrlAttribute(){
        $title_seo = Post::find( $this->post_id )->orig->title_seo;
        return route('showNews', ['title' => $title_seo ]);
    }

//    public function getVerifiedAtAttribute($value)
//    {
//        if ($value == null)
//            return null;
//        return toPersianNums(jalali()->forge($value)->format('%y/%m/%d - H:i:s'));
//    }

    public function scopeThisMonth($query)
    {
        return $query->where('created_at', '>', Carbon::now()->startOfMonth());
    }

    public function scopeUnverified($query)
    {
        return $query->where('verified', 0);
    }

    public function scopeToday($query)
    {
        return $query->where('created_at', '>', Carbon::now()->startOfDay());
    }

}
