<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IsiProdukFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                // 'unique:produks,name'
            ],
            'slug' => [
                'required',
                'max:255',
                // 'unique:produks,slug'
            ],
            'deskripsi' => [
                'required',
                'max:255',
            ],
            'id_kategori' => [
                'required',
            ],
            'id_sub_kategori' => [
                'required',
            ],
            'id_brand' => [
                'required',
            ],
            'harga_beli' => [
                'required',
                'integer'
            ],
            'harga_jual' => [
                'required',
                'integer'
            ],
            'jumlah' => [
                'required',
                'integer'
            ],
        ];
    }
}
