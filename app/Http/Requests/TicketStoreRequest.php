<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketStoreRequest extends FormRequest
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
            'department_id' => ['required', 'max:100', 'string'],
            'email' => ['required', 'unique:tickets', 'email', 'max:100'],
            'contact_name' => ['required'],
            // 'subject' => ['required'],
            'status' => ['required'],
            // 'product_id' => ['required'],
            'phone' => ['required'],
            // 'client_id' => ['required'],
            // 'service_category_id' => ['required'],
            // 'classification_id' => ['required'],
            // 'channel' => ['required'],
        ];
    }
}
