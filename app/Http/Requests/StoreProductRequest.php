<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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

            "nom_pro" => "required|string|max:255",            
            "double_puce" => "required|",
         
            "nb_jr_garantie" => "required|integer|min:365",
            "double_puce" => "required|boolean",

            "prix_g_tlf" => "required|integer|min:500",
            "prix_g_circuit" => "required|integer|min:500",
            "prix_g_batterie" => "required|integer|min:500",
            
        ];
    }
}
