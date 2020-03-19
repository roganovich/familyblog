<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Encore\Admin\Facades\Admin;

class CategoryFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Admin::user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:10|max:255',
            'slug' => 'max:255',
        ];
    }

    public function messages() {
        return [
            'title.required' => 'Введите имя поста',
            'title.min' => 'Имя поста не меньше :min символов'
        ];
    }


    public function attributes() {
        return [
            'title'=>'Заголовок',
            'category_id'=>'Категория',
            'description'=>'Контент',
        ];
    }
}
