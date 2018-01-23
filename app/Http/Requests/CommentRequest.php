<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CommentRequest extends Request
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
            'username' => 'required|min:4',
            'email' => 'email|required',
            'content' => 'min:5',
            'post_id' => 'numeric|required',
            'parent_cm_id' => 'numeric'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'نام نویسنده دیدگاه باید وارد کنید.',
            'username.min' => 'نام وارد شده حتما باید بیشتر از ۴ حرف باشد.',
            'email.email' => 'فرمت وارد شده برای ایمیل نادرست می باشد.',
            'email.required' => 'بایستی یک ایمیل جهت ثبت دیدگاه وارد کنید.',
            'content.min' => 'طول دیدگاه باید بیشتر از ۵ حرف باشد.',
            'post_id.numeric' => 'دیدگاه ارسال شده معتبر نیست',
            'parent_cm_id.numeric' => 'دیدگاه والدی که انتخاب کردید معتبر نیست'
        ];
    }
}
