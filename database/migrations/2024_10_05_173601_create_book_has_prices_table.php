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
            $table->string("book_id");
            $table->string("no_of_days_minimum");
            $table->string("rate_per_day");
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
