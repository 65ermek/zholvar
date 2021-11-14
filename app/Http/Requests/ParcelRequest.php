<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParcelRequest extends FormRequest
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
            'num' => ['required'],
            'phone' => ['required'],
            'email' => ['required'],
            'name' => ['required'],
            'last_name' => ['required'],
            'weight' => ['required'],
            'insurance' => ['required'],
            'parcelsender_id' => ['exists:parcel_senders,name', 'required'],
        ];
    }
}
