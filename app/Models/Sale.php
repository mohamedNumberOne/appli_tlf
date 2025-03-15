<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    /** @use HasFactory<\Database\Factories\SaleFactory> */
    use HasFactory;

    protected  $fillable  = [
        "product_id",
        "imei1",
        "imei2",
        "sn",
        "info_product_img",
        "nom_client",
        "tlf_client",
        "seller_id",
        'g_tlf',
        'batterie',
        'circuit',
        'total_garantie',
        
    ];
}
