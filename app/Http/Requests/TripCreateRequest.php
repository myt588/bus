<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TripCreateRequest extends Request
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
            'bus_id'            => 'required',
            'from'              => 'required',
            'to'                => 'required|different:from',
            'depart_at'         => 'required',
            'arrive_at'         => 'required|different:depart_at',
            'price'             => 'required',
            'discount'          => 'required',
            'weekdays'          => 'required',
            'depart_stops.*'    => 'required|distinct|same_city:from',
            'depart_times.*'    => 'required|distinct',
            'arrive_stops.*'    => 'required|distinct|same_city:to',
            'arrive_times.*'    => 'required|distinct',
        ];
        return $rules;
    }
}
