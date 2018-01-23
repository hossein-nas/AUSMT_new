<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateCommentRequest extends Request
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
            'name' => 'min:4|filled',
            'email' => 'email|filled',
            'content' => 'min:5|filled',
        ];
    }

    public function messages()
    {
        return [
            'username.min' => 'نام وارد شده حتما باید بیشتر از ۴ حرف باشد.',
            'email.email' => 'فرمت وارد شده برای ایمیل نادرست می باشد.',
            'content.min' => 'طول دیدگاه باید بیشتر از ۵ حرف باشد.',
        ];
    }
}
