<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\Admin\ActionButtonTrait;

class Article extends Model
{
    use ActionButtonTrait;
    protected $table = 'article';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cate_id',
        'article_name',
        'article_des',
        'article_content', 
        'article_author',
    ];

    public function cate()
    {
        return $this->hasOne(ArticleCate::class,'cate_id','id');
    }
}
