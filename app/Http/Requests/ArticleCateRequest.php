<?php

namespace App\Http\Requests;


class ArticleCateRequest extends Request
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
            'cate_name'=>'required',
            'cate_des'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'cate_name.required' => '请输入姓名',
            //'password.required' => '请输密码',
            'cate_des.required'=>'请选择角色'
        ];
    }
}
