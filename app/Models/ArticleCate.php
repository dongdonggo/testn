<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Admin\ActionButtonTrait;
use App\Traits\Admin\Article;

class ArticleCate extends Model
{
    use ActionButtonTrait;
    protected $table = 'article_cate';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cate_name',
        'cate_des',
        'created_at',
        'updated_at'
    ];

    public function article()
    {
        return $this->hasMany(Article::class, 'id', 'cate_id');
    }   
}
