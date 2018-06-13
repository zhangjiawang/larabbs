<?php

namespace App\Http\Requests;

class ReplyRequest extends Request
{
    public function rules()
    {

        return [
            'content' => 'required|min:2'
        ];
    }

    public function messages()
    {
        return [
            'content.required' => "内容不允许为空！",
            'content.min' => "内容最少为 2 个字符！",

        ];
    }
}
