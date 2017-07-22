<?php

namespace App\Repositories\Eloquent;

use DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\Article;
use Hash;

/**
 * Class MenuRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class ArticleRepositoryEloquent extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Article::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function ajaxIndex($request)
    {
        $draw = $request->input('draw', 1);
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);
        $search['value'] = $request->input('search.value', '');
        $search['regex'] = $request->input('search.regex', false);
        if ($search['value']) {
            if ($search['regex'] == 'true') {//传过来的是字符串不能用bool值比较
                $this->model = $this->model->where('article_name', 'like', "%{$search['value']}%");
            } else {
                $this->model = $this->model->where('article_name', $search['value']);
            }
        }
        $count = $this->model->count();
        $this->model = $this->model->offset($start)->limit($length)->get();

        if($this->model){
            foreach ($this->model as $item) {
                $item->button = $item->getActionButtons('article');
            }
        }

        return [
            'draw' => $draw,
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'data' => $this->model
        ];
    }

    public function createArticle(array $attr)
    {
        $article = new Article();
        $article->article_name = $attr['article_name'];
        $article->article_des = $attr['article_des'];
        $res = $article->save();
        if($res){
            flash('文章新增成功', 'success');
        }else{
            flash('文章新增失败', 'error');
        }
        
    }

    public function editViewData($id)
    {
        $article = $this->model->find($id,['id','article_name','article_des'])->toArray();
        return compact('article');
    }

    public function updateArticle(array $attr, $id)
    {
        $res = $this->update($attr,$id);

        if($res){
            flash('修改成功', 'success');
        }else{
            flash('修改失败', 'error');
        }
    }

}
