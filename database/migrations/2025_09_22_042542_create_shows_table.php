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
        Schema::create('shows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movie_id')->constrained()->onDelete('cascade');
            $table->foreignId('hall_id')->constrained()->onDelete('cascade');
            $table->dateTime('start_time');
            $table->decimal('ticket_price', 8, 2);
            $table->integer('points_value')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');
            $table->foreign('hall_id')->references('id')->on('halls')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shows');
    }
};
