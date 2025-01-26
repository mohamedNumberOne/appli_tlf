<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\ForeignKeyDefinition;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')-> nullable();
            $table->string('imei1')-> unique();
            $table->string('imei2')-> unique();
            $table->string('sn') ;
            $table->string('info_product_img');
            $table->string('nom_client'); 
            $table->string('tlf_client'); 
            $table-> foreign("product_id") -> references('id') ->  on('products')->onDelete('SET NULL') ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
