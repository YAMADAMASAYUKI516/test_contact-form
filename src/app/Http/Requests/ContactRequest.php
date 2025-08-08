<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'category_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'email' => 'required | email',
            'tel1' => 'nullable',
            'tel2' => 'nullable',
            'tel3' => 'nullable',
            'address' => 'required',
            'detail' => 'required | max:120',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'お問い合わせの種類を入力してください',
            'first_name.required' => '名を入力してください',
            'last_name.required' => '姓を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'address.required' => '住所を入力してください',
            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.max' => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $tel1 = $this->input('tel1');
            $tel2 = $this->input('tel2');
            $tel3 = $this->input('tel3');

            // 全て未入力の場合
            if (empty($tel1) || empty($tel2) || empty($tel3)) {
                $validator->errors()->add('tel_group', '電話番号を入力してください');
            } else {
                // いずれかが6桁以上または数字でない
                $pattern = '/^\d{1,5}$/';
                if (
                    (!empty($tel1) && !preg_match($pattern, $tel1)) ||
                    (!empty($tel2) && !preg_match($pattern, $tel2)) ||
                    (!empty($tel3) && !preg_match($pattern, $tel3))
                ) {
                    $validator->errors()->add('tel_group', '電話番号は5桁までの数字で入力してください');
                }
            }
        });
    }
}
