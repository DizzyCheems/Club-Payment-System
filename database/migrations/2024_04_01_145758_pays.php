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
        //
        Schema::create('pays', function (Blueprint $table) {
            $table->id();            
            $table->unsignedBigInteger('payment_id')->nullable(); 
            $table->unsignedBigInteger('student_id')->nullable();
            $table->integer('amount');
            $table->string('ref_num');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('pays');
    }
};
