<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
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
            'name' => 'required|between:3,25|regex:/^[\x{4e00}-\x{9fa5}_a-zA-Z0-9-]+$/u|unique:users,name,' . Auth::id(),
            'email' => 'required|email|unique:users,email,' .  Auth::id(),
            'introduction' => 'max:80',
            'avatar' => 'mimes:jpeg,png,gif,jpg|dimensions:min_width=200,min_height=200',
        ];
    }

    public function messages()
    {
        return [
            'avatar.mimes' =>'头像必须是 jpeg, png, gif, jpg 格式的图片',
            'avatar.dimensions' => '图片的清晰度不够，宽和高需要 200px 以上',
            'name.required' => '用户名不能为空',
            'name.between' => '用户名必须介于 3 - 25 个字符之间',
            'name.unique' => '用户名已被占用，请重新填写',
            'name.regex' => '用户名只支持中英文、数字、横杆和下划线'
        ];
    }
}
