<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOfferRequest extends FormRequest
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
            'name_en' => 'required|unique:offers,name_en,'.$this->offer->id,
            'name_ar' => 'required|unique:offers,name_ar,'.$this->offer->id,
        ];
    }


    public function attributes()
    {
        return [
            'name_en' => 'Offer Name',
            'name_ar' => 'اسم العرض',
        ];
    }
}
