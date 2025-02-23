<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            // copie de la table sales
            $table->unsignedBigInteger("sale_id")->nullable();
            $table->unsignedBigInteger('product_id')->nullable();

            $table->string('imei1') ;
            $table->string('imei2') ;
            $table->string('sn');
            $table->string('info_product_img');
            $table->string('nom_client');
            $table->string('tlf_client');


            $table->foreign("sale_id")->references('id')->on('sales')->onDelete('SET NULL');
            $table->foreign("product_id")->references('id')->on('products')->onDelete('SET NULL');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
