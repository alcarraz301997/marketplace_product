<?php

namespace App\Http\Requests\Product;

use App\Constant\ErrorHttp;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreProductRequest extends FormRequest
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
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric|min:0.01',
            'stock' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'  => 'Nombre del producto es requerido.',
            'price.min'      => 'El precio debe ser mayor a 0.',
            'stock.min'      => 'El stock no debe ser negativo.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'error'  => true,
            'message' => 'Error de validación en los datos enviados.',
            'errors'  => $validator->errors(),
        ], ErrorHttp::UNPROCESSABLE_ENTITY));
    }
}
