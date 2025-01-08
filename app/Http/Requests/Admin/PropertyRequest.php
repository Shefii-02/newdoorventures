<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;

class PropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Update this if you want to restrict access based on specific conditions
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'property_name' => 'required|string|max:220',
            'description' => 'nullable|string|max:350',
            'city'     => 'required|string',
            'locality'     => 'required|string',
            // 'location'     => 'required|string',
            'content' => 'nullable|string',
            'number_bedroom' => 'nullable|numeric|min:0|max:100000',
            'number_bathroom' => 'nullable|numeric|min:0|max:100000',
            'number_floor' => 'nullable|numeric|min:0|max:100000',
            'price' => 'required|numeric|min:0',
            'account' => 'required'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'property_name.required' => 'Property name is required.',
            'property_name.string' => 'Property name must be a string.',
            'property_name.max' => 'Property name cannot exceed 220 characters.',
            'description.string' => 'Description must be a string.',
            'description.max' => 'Description cannot exceed 350 characters.',
            'number_bedroom.numeric' => 'Number of bedrooms must be a number.',
            'number_bathroom.numeric' => 'Number of bathrooms must be a number.',
            'number_floor.numeric' => 'Number of floors must be a number.',
            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be a valid number.',
            'price.min' => 'Price must be at least 0.',
            'account.required' => 'Property owner account is required.',
            // 'latitude.regex' => 'Latitude must be a valid coordinate.',
            // 'longitude.regex' => 'Longitude must be a valid coordinate.',
        ];
    }

    /**
     * Get custom attribute names.
     *
     * @return array
     */
    // public function attributes(): array
    // {
    //     return [
    //         'property_name' => 'property name',
    //         'description' => 'property description',
    //         'price' => 'property price',
    //     ];
    // }

    protected function failedValidation(Validator $validator)
    {
        // Collecting all the validation errors in a readable format
        $errors = $validator->errors()->all();

        // Logging a message and the validation errors
        Log::error('Validation failed: Property error');
        Log::error('Validation Errors: ' . json_encode($errors));




        // Throw a custom response with all errors
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'message' => 'Validation failed.',
            'errors' => $errors,  // Collect all errors as an array
        ], 422));
    }
}
