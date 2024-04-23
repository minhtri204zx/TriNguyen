<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
                'Link' => 'required|url',
            
            //
        ];
    }
    public function messages()
    {
        return [
                'Link.url' => 'Link không hợp lệ. Vui lòng nhập một URL đúng định dạng.',
                'Link.required' => 'Link không được để trống. Điền vào đi',
        ];
    }
}
