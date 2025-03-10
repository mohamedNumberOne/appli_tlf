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
        Schema::create('payment__com__admins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->unsignedBigInteger('commercial_id')->nullable();
            $table->unsignedBigInteger('id_payment__store__com')->nullable();
            $table->boolean('payment_done')->default(0);

            $table->unsignedSmallInteger('montant');

            $table->foreign("admin_id")->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign("commercial_id")->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign("id_payment__store__com")->references('id')->on('payment__store__coms')->onDelete('SET NULL');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment__com__admins');
    }
};
