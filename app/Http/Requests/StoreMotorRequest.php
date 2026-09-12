<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMotorRequest extends FormRequest
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
            'color' => ['required', 'string', 'max:100'],
            'model' => ['required', 'string', 'max:100'],
            'year' => ['required', 'digits:4', 'integer', 'min:1980', 'max:' . (date('Y') + 1)],
            'plate_number' => ['required', 'string', 'max:20', 'unique:motors,plate_number'],
            'price_per_day' => ['required', 'numeric', 'min:0'],
            'deposit' => ['required', 'numeric', 'min:0'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'status' => ['required', 'in:available,rented,maintenance,inactive'],
        ];
    }
}
