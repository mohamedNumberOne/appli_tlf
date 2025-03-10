<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warranty_Product extends Model
{
    /** @use HasFactory<\Database\Factories\WarrantyProductFactory> */
    use HasFactory;
    
    protected $fillable = [

        'warranty_id',
        'product_id',
        'prix',
         
    ] ;
}
