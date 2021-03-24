<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductCategoryRequest extends FormRequest
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
            'name' => 'required|unique:product_categories,name,'.$this->id,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'A Category Name is required.',
            'name.unique' => 'This Category Name is Already Exist.'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Category Name',
        ];
    }
}
