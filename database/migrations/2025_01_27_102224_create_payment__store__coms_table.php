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
        Schema::create('payment__store__coms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller_id')->nullable();
            $table->unsignedBigInteger('commercial_id')->nullable();
            $table->boolean('seller_engagement')->default(0);
            $table->boolean('commercial_engagement')->default(0);
            $table->string('photo_money');
            $table->unsignedSmallInteger('montant');
            $table->boolean('payment_done')->default(0);  


            $table->foreign("seller_id")->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign("commercial_id")->references('id')->on('users')->onDelete('SET NULL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment__store__coms');
    }
};
