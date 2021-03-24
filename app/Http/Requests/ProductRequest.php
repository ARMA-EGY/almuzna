<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name_en' => 'required|unique:products',
            'name_ar' => 'required|unique:products',
        ];
    }

    public function messages()
    {
        return [
            'name_en.unique' => 'This Product Name is already exisit.',
            'name_ar.unique' => 'This Product Name is already exisit.'
        ];
    }

    public function attributes()
    {
        return [
            'name_en' => 'Product Name',
            'name_ar' => 'اسم المنتج',
        ];
    }
}
