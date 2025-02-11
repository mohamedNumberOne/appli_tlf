<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return 1;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {


        return [
            // 'product_id' => 'required|exists:products,id|numeric',
            // 'seller_id' => 'required|exists:users,id|numeric',
            // 'imei1' => 'required|digits:15|unique:sales,imei1',
            // 'sn' => 'required|string',
            // 'info_product_img' => 'required|file|image|mimes:jpeg,png,jpg,gif,bmp,webp',
            // 'nom_client' => 'required|string',
            // 'tlf_client' => 'required|digits_between:8,15',
            // 'imei2' => 'required|digits:15|unique:sales,imei2'  
        ];
    }


    public function messages(): array
    {


        return [
            'product_id.exists' => 'le produit n\'existe pas',
            'imei1.digits' => 'IMEI1 doit contenir 15 chiffres',
            'imei2.digits' => 'IMEI2 doit contenir 15 chiffres',
            
        ];

    }

}
