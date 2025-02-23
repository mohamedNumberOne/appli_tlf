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
        Schema::create('return_ps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("sale_id")-> nullable();
            $table->string("problem")  ;

            $table->foreign("sale_id")->references('id')->on('sales')->onDelete('SET NULL');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_ps');
    }
};
