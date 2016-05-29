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
            'from'              => 'required|max:100',
            'to'                => 'required|max:100|different:from',
            'depart'            => 'required|date_format:m/d/Y',
            'return'            => 'date_format:m/d/Y|after_equal:depart|required_if:options,round-trip',
            'adults'            => 'required|integer|min:0',
            'kids'              => 'required|integer|min:0',
            'options'           => 'required',
            'date_new'          => 'integer',
        ];
    }
}
