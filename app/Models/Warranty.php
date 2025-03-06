<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warranty extends Model
{
    /** @use HasFactory<\Database\Factories\WarrantyFactory> */
    use HasFactory;

    protected $fillable = [
        "type_garantie",
        "prix_garantie",

    ] ;
}
