<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use App\Http\Controllers\Controller;
use App\Models\Article;
use Validator;
use App\Repositories\Eloquent\ArticleRepositoryEloquent as ArticleRepository;

class ArticleController extends Controller
{

	private $article;

    public function __construct(ArticleRepository $ArticleRepository)
    {
        $this->article = $ArticleRepository;
    }


    public function index()
    {
        return view('admin.article.index');
    }

    public function create(){
        return view('admin.article.create');
    }

    public function store(ArticleRequest $request){
        $this->article->createArticle($request->all());

        return redirect('admin/article');
    }

    public function edit($id){
        $article = $this->article->editViewData($id);

        return view('admin.article.edit',compact('article'));
    }

    public function update(ArticleRequest $request, $id){
        $this->article->updateArticle($request->all(), $id);

        return redirect('admin/article'); 
    }

    public function ajaxIndex(Request $request)
    {
        $result = $this->article->ajaxIndex($request);
        return response()->json($result,JSON_UNESCAPED_UNICODE);
    }
}
