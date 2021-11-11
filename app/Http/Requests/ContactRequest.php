<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
                'quote_owner' => 'required',
                'status' => 'required',
                'subject' => 'required',
                'team' => 'required',
                'deal_name' => 'required',
                'valid_until' => 'required',
                'contact_id' => 'r',
                'billing_street' => 'required',
                'billing_city' => 'required',
                'billing_state' => 'required',
                'billing_code' => 'required',
                'billing_country' => 'required',
                'shipping_street' => 'required',
                'shipping_city' => 'required',
                'shipping_state' => 'required',
                'shipping_code' => 'required',
                'shipping_country' => 'required',
        ];
    }
}
