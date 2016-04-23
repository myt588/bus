<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class HomeSearchRequest extends Request
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
            'leaving_from'      => 'required|max:100',
            'going_to'          => 'required|max:100|different:leaving_from',
            'depart'            => 'required|date_format:m/d/Y',
            'return'            => 'date_format:m/d/Y|after_equal:depart|required_if:options,round-trip',
            'adults_depart'     => 'required|integer|min:0',
            'kids_depart'       => 'required|integer|min:0',
            'options'           => 'required',
            'date_new'          => 'integer',
        ];
    }
}
