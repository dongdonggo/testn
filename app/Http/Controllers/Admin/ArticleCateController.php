<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\ArticleCateRequest;
use App\Http\Controllers\Controller;
use App\Models\ArticleCate;
use Validator;
use App\Repositories\Eloquent\ArticleCateRepositoryEloquent as ArticleCateRepository;

class ArticleCateController extends Controller
{

	private $article_cate;

    public function __construct(ArticleCateRepository $ArticleCateRepository)
    {
        $this->article_cate = $ArticleCateRepository;
    }


    public function index()
    {
        return view('admin.article_cate.index');
    }

    public function create(){
        return view('admin.article_cate.create');
    }

    public function store(ArticleCateRequest $request)
    {
        // var_dump(123456);exit();
        $this->article_cate->createArticleCate($request->all());
        return redirect('admin/article-cate');
    }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->article_cate->editViewData($id);
        return view('admin.article_cate.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     * @param RoleRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ArticleCateRequest $request, $id)
    {
        $this->article_cate->updateArticleCate($request->all(),$id);
        return redirect('admin/article-cate');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
    public function ajaxIndex(Request $request)
    {
        $result = $this->article_cate->ajaxIndex($request);
        return response()->json($result,JSON_UNESCAPED_UNICODE);
    }
}
