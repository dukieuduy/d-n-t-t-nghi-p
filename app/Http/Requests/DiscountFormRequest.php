<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountFormRequest extends FormRequest
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
            'code' => [
                'required', 'string', 'max:255',
                request()->isMethod('POST') ? 'unique:discounts,code' : 'unique:discounts,code,' . $this->route('discount')
            ],
            'type' => ['required', 'in:percentage,fixed,shipping'],
            'value' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) {
                    if ($this->type === 'percentage' && ($value < 0 || $value > 100)) {
                        $fail('Giá trị chỉ được từ 0% đến 100%');
                    }

                    if ($this->type === 'fixed' && $value < 0) {
                        $fail('Giá trị phải lớn hơn 0 vnđ');
                    }
                },
            ],
            'start_date' => ['required', 'date', 'before:end_date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'min_purchase_amount' => ['required', 'numeric', 'min:0'],
            'max_purchase_amount' => ['nullable', 'numeric', 'min:0'],
            'quantity' => ['required', 'numeric', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
