<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment_Com_Admin extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentComAdminFactory> */
    use HasFactory;

    protected  $fillable  = [

        "admin_id",
        "commercial_id",
        "id_payment__store__com",
        "payment_done",
        "montant",
 

 

    ];
}
