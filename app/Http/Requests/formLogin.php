<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class formLogin extends FormRequest
{
 
  

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ];
    }

    public function messages()
    {
        return [
            'email.email' => 'Email không hợp lệ. Vui lòng nhập một Email đúng định dạng.', // Thông báo lỗi cho trường 'link' không đúng định dạng URL
            'email.required' => 'Email không được để trống. Điền vào đi', // Thông báo lỗi cho trường 'link' bắt buộc
            'email.unique' => 'Email đã tồn tại', // Thông báo lỗi cho trường 'link' bắt buộc
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu không được dưới 8 kí tự'
        ];
    }
}
