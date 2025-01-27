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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("category_id")->nullable();
            $table->unsignedBigInteger("brand_id")->nullable();
            $table->string("product_name");
            $table->unsignedSmallInteger("prix_garantie")->nullable()->default(0);
            $table->unsignedSmallInteger("nb_jr_garantie")->nullable();
            $table->boolean("double_puce");
            $table->boolean("actif")->default(1);

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('SET NULL');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('SET NULL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
