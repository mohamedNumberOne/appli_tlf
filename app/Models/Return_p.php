<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Return_p extends Model
{
    /** @use HasFactory<\Database\Factories\ReturnPFactory> */
    use HasFactory;

    protected  $fillable  = [

        "sale_id",
        "problem",

    ];
}
