<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment_Store_Com extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentStoreComFactory> */
    use HasFactory;

    protected  $fillable  = [

        "seller_id",
        "commercial_id",
        "seller_engagement",
        "commercial_engagement",
        "photo_money",
        "montant",
        "payment_done",

    ];

}
