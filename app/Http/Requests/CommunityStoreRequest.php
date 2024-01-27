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
            'name' => ['required', Rule::unique('communities')->ignore($communityId),],
            'description' => ['required', 'min:5']
        ];
    }

    public function messages() : array
    {
        return [
            'name.required' => 'Название сообщества обязательно к заполнению.',
            'description.required' => 'Описание сообщества обязательно к заполнению.'
        ];
    }
}
