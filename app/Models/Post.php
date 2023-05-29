<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id', 'title', 'content', 'category','image'
    ];
    
    protected $guarded = array('id');

    public static $rules = array(
        'title' => 'required',
        'content' => 'required',
        );
    
    public function comments()
    {
    return $this->hasMany('App\Models\Comment');
    }
    
    // PostとCategoryの関連を定義する
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
