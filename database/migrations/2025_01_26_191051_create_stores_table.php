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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string("store_name");
            $table->unsignedBigInteger("id_added_by_com")->nullable();
            $table->unsignedBigInteger("id_prop")->nullable();
            $table->integer("total_to_pay")->nullable()->default(0) ;

            $table->foreign("id_added_by_com")->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign("id_prop")->references('id')->on('users')->onDelete('SET NULL');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
