<?php

namespace App\Http\Requests\Api\Employee;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'employeeName' => 'required|string|max:150',
            'role' => 'required|string|max:150',
            'startDate' => 'required|date|date_format:Y-m-d', // Ensure format is checked
            'endDate' => 'required|date|date_format:Y-m-d|after:startDate', // Ensure endDate is after startDate
            'salary' => 'required|numeric|min:0|max:99999999.99', // Use numeric instead of decimal
            'terms' => 'required|string|max:255',
            'otherDetails.department' => 'required|string|max:255',
            'otherDetails.manager' => 'required|string|max:255',
        ];
    }
}
