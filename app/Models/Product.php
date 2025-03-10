<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected  $fillable  = [

        "category_id",
        "brand_id",
        "product_name",
        "nb_jr_garantie",
        "double_puce",
        'prix_g_tlf',
        'prix_g_circuit',
        'prix_g_batterie',


    ];
}
