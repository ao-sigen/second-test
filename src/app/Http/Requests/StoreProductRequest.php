<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name'        => 'required|string',
            'price'       => 'required|numeric|min:0|max:10000',
            'season'      => 'required|array|min:1',
            'season.*'    => 'exists:seasons,id',
            'description' => 'required|string|max:120',
            'image'       => 'required|image|mimes:png,jpeg,jpg,webp',
        ];
    }
    public function messages()
    {
        return [
            'name.required'        => '商品名を入力してください',
            'price.required'       => '値段を入力してください',
            'price.numeric'        => '数値で入力してください',
            'price.min'            => '0~10000円以内で入力してください',
            'price.max'            => '0~10000円以内で入力してください',
            'season.required'      => '季節を選択してください',
            'season.*.in'          => '不正な季節の値が含まれています',
            'description.required' => '商品説明を入力してください',
            'description.max'      => '120文字以内で入力してください',
            'image.required' => '商品画像を選択してください',
            'image.mimes'          => '「.png」または「.jpeg」形式でアップロードしてください',
            'image.image'          => '商品ファイルを選択してください',
        ];
    }
}
