<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FileUploadRequest extends Request
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
            'file_description' => 'string',
            'file_title' => 'string',
            'file_orig_name' => 'required|string',
            'cat_id' => 'required|numeric'
        ];
    }

    public function messages(){
        return [
            'file_description.string' => 'فیلد توضیحات بایستی فقط شامل نوشته فارسی یا لاتین باشد',
            'file_title.string' => 'فیلد عنوان بایستی فقط شامل نوشته فارسی یا لاتین باشد',
            'file_orig_name.string' => 'نام فایل انتخابی قابل قبول نیست',
            'file_orig_name.required' => 'مشکلی در فایل انتخابی وجود دارد',
            'cat_id.numeric' => 'دسته انتخابی برای فایل قابل قبول نیست',
            'cat_id.required' => 'انتخاب دسته برای فایل ضروری است',
        ];
    }
}
