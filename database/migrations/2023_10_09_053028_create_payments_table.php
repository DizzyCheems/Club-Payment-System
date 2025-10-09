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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agenda_id')
                ->nullable()
                ->constrained('agendas')
                ->onDelete('cascade');
            $table->foreignId('student_id')
                    ->nullable()
                    ->constrained('students')
                    ->onDelete('cascade');
            $table->integer('amount');
            $table->string('type');
            $table->string('method')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
