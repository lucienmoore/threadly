<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CommunityStoreRequest extends FormRequest
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
        $communityId = $this->route('community'); 
        return [
            'name' => ['required', 'min:5', 'max:25', Rule::unique('communities')->ignore($communityId),],
            'description' => ['required', 'min:5', 'max:255']
        ];
    }

    public function messages() : array
    {
        return [
            'name.required' => 'Название сообщества обязательно к заполнению.',
            'name.min' => 'Количество символов в поле название должно быть не меньше 5.',
            'name.max' => 'Количество символов в поле название не должно быть больше 25',
            'description.required' => 'Описание сообщества обязательно к заполнению.'
        ];
    }
}
