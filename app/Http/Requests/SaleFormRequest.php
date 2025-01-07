<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleFormRequest extends FormRequest
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
            'name' => 'required',
            'products' => 'required|array',
            'products.*' => 'exists:products,id',
            'percentage' => 'required|numeric|min:0|max:100',
            'issue_date' => 'required|date',
            'expired_date' => 'required|date|after_or_equal:issue_date',
        ];
    }
}
