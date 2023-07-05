<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\Console\Input\Input;

class StoreAlertRequest extends FormRequest
{
    public function messages()
    {
        return [
            'area-lat-lngs.required' => 'Dodaj obszar do mapy.',
        ];
    }

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'description' => 'nullable|min:3|max:1024',
            'category_id' => 'required',
            'valid_from' => 'required',
            'valid_to' => 'required',
            'area-lat-lngs' => 'required_if:alert-area-type,0',
        ];
    }
}
