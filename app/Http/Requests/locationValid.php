<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class locationValid extends FormRequest
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
            'orderlat-modal' => 'required',
            'orderlong-modal' => 'required',
            'delivery_address-modal' => 'required',
        ];
    }
}
