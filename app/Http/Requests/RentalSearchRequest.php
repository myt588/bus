<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RentalSearchRequest extends Request
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
            "location"      => 'required|max:100',
            "passengers"    => 'required|max:100',
            "start_at"      => 'required',
            "start"         => 'required|date_format:m/d/Y',
            "end_at"        => 'required',
            "end"           => 'date_format:m/d/Y|after_equal:start',
        ];
    }
}
