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
        Schema::create('book_issues', function (Blueprint $table) {
            $table->id();
            $table->integer("due");
            $table->integer("paid");
            $table->integer("total");
            $table->integer("card_holder_id");
            $table->string("status");
            $table->string("issued_at")->nullable();
            $table->string("returned_at")->nullable();
            $table->string("from_date");
            $table->string("to_date");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_issues');
    }
};
