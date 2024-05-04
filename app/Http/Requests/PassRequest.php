<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PassRequest extends FormRequest
{
    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
                'pass' => 'required|min:4'
        ];
    }

    public function messages()
    {
        return [
                'pass.required' => 'Không được để trống',
                'pass.min'=>'mật khẩu trên 4 kí tự'
            ];
    }
}
