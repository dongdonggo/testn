<?php

namespace App\Http\Requests;


class ArticleRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'article_name'=>'required',
            // 'article_des'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'article_name.required' => '请输入文章名称',
        ];
    }
}
