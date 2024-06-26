<?php

namespace App\Http\Requests\Backoffice;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:100',
            'role_id' => 'required|exists:roles,id',
            'is_active'=>'required|boolean'
        ];

        if (
            $this->email != null
            &&
            ($this->isMethod('PUT') || $this->input('_method') == 'PUT')
        ) {
            $rules['email'] = [
                'email',
                'required',
                Rule::unique('users')->ignore($this->route('user')->id),
            ];

            $rules['password'] = ['nullable'];
        }

        return $rules;
    }
}
