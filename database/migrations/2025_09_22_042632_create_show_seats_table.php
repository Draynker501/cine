<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('show_seats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hall_id')->constrained()->onDelete('cascade');
            $table->foreignId('seat_id')->constrained()->onDelete('cascade');
            $table->string('status');
            $table->timestamps();

            $table->foreign('hall_id')->references('id')->on('halls')->onDelete('cascade');
            $table->foreign('seat_id')->references('id')->on('seats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('show_seats');
    }
};
