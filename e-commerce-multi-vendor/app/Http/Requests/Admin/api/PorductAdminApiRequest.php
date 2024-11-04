<?php

namespace App\Http\Requests\Admin\api;

use Illuminate\Foundation\Http\FormRequest;

class PorductAdminApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255', 'string'],
            'description' => ['string', 'max:255'],
            'category' => ['required'],
            'price' => ['required'],
            'quantity' => ['required'],
            'image' => ['required']
        ];
    }
}