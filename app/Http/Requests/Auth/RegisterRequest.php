<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:191',
            'email' => 'required|email|min:8|max:191|unique:users',
            'password' => 'required|min:8|max:191|',
            
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前を入力してください',
            'name.string' => '名前は文字列にしてください',
            'name.max' => '名前に入力できる文字数は191文字までです',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスの形式で入力してください',
            'email:min' => 'メールアドレスは8文字以上で入力してください',
            'email:max' => 'メールアドレスに入力できる文字数は191文字までです',
            'email.unique' => 'そのメールアドレスはすでに登録されています',
            'password.required' => 'パスワードを入力してください',
            'password:min' => 'パスワードは8文字以上で入力してください',
            'password:max' => 'パスワードに入力できる文字数は191文字までです',
        ];
    }
}
