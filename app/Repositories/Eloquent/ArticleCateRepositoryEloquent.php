<?php

namespace App\Repositories\Eloquent;

use DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\ArticleCate;
use Hash;

/**
 * Class MenuRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class ArticleCateRepositoryEloquent extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ArticleCate::class;
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
                $this->model = $this->model->where('cate_name', 'like', "%{$search['value']}%");
            } else {
                $this->model = $this->model->where('cate_name', $search['value']);
            }
        }
        $count = $this->model->count();
        $this->model = $this->model->offset($start)->limit($length)->get();

        if ($this->model) {
            foreach ($this->model as $item) {
                $item->button = $item->getActionButtons('article-cate');
            }
        }
        return [
            'draw' => $draw,
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'data' => $this->model
        ];
    }

    public function createArticleCate(array $attr)
    {
        $article_cate = new ArticleCate();
        $article_cate->cate_name = $attr['cate_name'];
        $article_cate->cate_des = $attr['cate_des'];
        $article_cate->save();

        flash('分类新增成功', 'success');
    }

    public function editViewData($id)
    {
        $article_cate = $this->model->find($id,['id','cate_name','cate_des'])->toArray();

        return compact('article_cate');
    }

    public function updateArticleCate(array $attr, $id)
    {
        $res = $this->update($attr,$id);
        if ($res) {
            flash('修改成功!', 'success');
        } else {
            flash('修改失败!', 'error');
        }
        return $res;
    }


}
