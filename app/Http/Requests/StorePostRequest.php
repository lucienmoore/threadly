<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() : array
    {
        return [
            'title' => ['required', 'min:5', 'max:30'],
            'description' => ['nullable', 'max:1000'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png'],
        ];
    }

    public function messages() : array
    {
        return [
            'title.required' => 'Поле заголовок обязательно.',
        ];
    }
}
