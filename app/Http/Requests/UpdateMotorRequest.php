<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMotorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->role === 'admin';
    }

    public function rules(): array
    {
        return [
            'motor_category_id' => ['required', 'exists:motor_categories,id'],
            'merk' => ['required', 'string', 'max:100'],
            'warna' => ['required', 'string', 'max:100'],
            'model' => ['required', 'string', 'max:100'],
            'year' => ['required', 'digits:4', 'integer', 'min:1980', 'max:' . (date('Y') + 1)],
            'plate_number' => [
                'required', 'string', 'max:20',
                Rule::unique('motors', 'plate_number')->ignore($this->route('motor')),
            ],
            'price_per_day' => ['required', 'numeric', 'min:0'],
            'deposit' => ['required', 'numeric', 'min:0'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'status' => ['required', 'in:available,rented,maintenance,inactive'],
        ];
    }
}
