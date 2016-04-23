<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TicketCheckoutRequest extends Request
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
            'first_name'        => 'required|max:100',
            'last_name'         => 'required|max:100',
            'email'             => 'required|email|max:255',
            'phone'             => 'required',
            'agreement'         => 'required',
        ];

        if (!auth()->check())
        {
            $rule['email_re'] = 'required|same:email';
        }

        $this->travellerRules('adults_depart', $this->adults_depart, $rules);
        $this->travellerRules('kids_depart', $this->kids_depart, $rules);
        if ($this->has('trip_two_id')){
            $this->travellerRules('adults_return', $this->adults_return, $rules);
            $this->travellerRules('kids_return', $this->kids_return, $rules);
        }
        return $rules;
    }

    public function travellerRules($name, $max, &$rules)
    {
        for ($i = 1; $i < $max + 1; $i++) {
            $rules[$name . '_' . $i] = 'required';
        }
    }
}
