<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCityRequest extends FormRequest
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
            'name_en' => 'required',
            'name_ar' => 'required',
            'area_en' => 'required|unique:cities,area_en,'.$this->city->id,
            'area_ar' => 'required|unique:cities,area_ar,'.$this->city->id,
        ];
    }

    public function messages()
    {
        return [
            'name_en.required' => 'A City Name is required.',
            'name_ar.required' => 'A City Name is required.',
            'area_en.required' => 'A City Name is required.',
            'area_ar.required' => 'A City Name is required.',
            'area_en.unique' => 'This Area Name is Already Exist.',
            'area_ar.unique' => 'This Area Name is Already Exist.',
        ];
    }


}
