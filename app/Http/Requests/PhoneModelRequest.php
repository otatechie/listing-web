<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhoneModelRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'model_number' => [
                'required',
                'string',
                'regex:/^[A-Z0-9\-]+$/i', // Only allow letters, numbers, and hyphens
                'min:3',
                'max:50',
                function ($attribute, $value, $fail) {
                    // Custom validation for specific brand formats
                    $brand = Brand::find($this->brand_id);
                    if ($brand->name === 'iPhone') {
                        if (!preg_match('/^(iPhone|A)\d{1,4}/', $value)) {
                            $fail('Invalid iPhone model number format.');
                        }
                    }
                }
            ],
            'brand_id' => 'required|exists:brands,id'
        ];
    }

    public function messages(): array
    {
        return [
            'model_number.regex' => 'Model number can only contain letters, numbers, and hyphens.',
        ];
    }
}
