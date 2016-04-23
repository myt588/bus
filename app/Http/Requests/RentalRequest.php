<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RentalRequest extends Request
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
            'company_id'        => 'required',
            'bus_id'            => 'required',
            'description'       => 'required',
            'one_day'           => 'required',
            'three_days'        => 'required',
            'one_week'          => 'required',
        ];
        return $rules;
    }
}
