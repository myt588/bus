<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Company;

class BusRequest extends Request
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
        $rules = [
            'license_plate'     => 'required|max:10',
            'make'              => 'required',
            'model'             => 'required',
            'year'              => 'required|integer|min:1900|max:2050',
            'seats'             => 'required|integer|min:0',
        ];
        return $rules;
    }
}
