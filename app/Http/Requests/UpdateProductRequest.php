<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name_en' => 'required|unique:products,name_en,'.$this->product->id,
            'name_ar' => 'required|unique:products,name_ar,'.$this->product->id,
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
