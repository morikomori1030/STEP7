<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // 認可チェックしないなら true
    }

    public function rules(): array
    {
        return [
            'product_name' => ['required','string','max:255'],
            'company_id'   => ['required','exists:companies,id'],
            'price'        => ['required','integer','min:0'],
            'stock'        => ['required','integer','min:0'],
            'comment'      => ['nullable','string','max:1000'],
            'img_path'     => ['nullable','image','mimes:jpg,jpeg,png,gif,webp','max:2048'],
        ];
    }

    // 日本語メッセージ
    public function messages(): array
    {
        return [
            'required'           => ':attribute は必須です。',
            'string'             => ':attribute は文字列で入力してください。',
            'integer'            => ':attribute は数値で入力してください。',
            'min'                => ':attribute は :min 以上を指定してください。',
            'max'                => ':attribute は :max 文字（または :max KB）以内で指定してください。',
            'exists'             => '選択された :attribute が存在しません。',
            'image'              => ':attribute は画像ファイルを指定してください。',
            'mimes'              => ':attribute は :values 形式のファイルを指定してください。',
        ];
    }

    // 日本語の属性名
    public function attributes(): array
    {
        return [
            'product_name' => '商品名',
            'company_id'   => 'メーカー',
            'price'        => '価格',
            'stock'        => '在庫数',
            'comment'      => 'コメント',
            'img_path'     => '商品画像',
        ];
    }
}