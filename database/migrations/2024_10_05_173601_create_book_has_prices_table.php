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
        Schema::create('book_has_prices', function (Blueprint $table) {
            $table->id();
            $table->integer("book_id");
            $table->integer("no_of_days_minimum");
            $table->integer("rate_per_day");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_has_prices');
    }
};
