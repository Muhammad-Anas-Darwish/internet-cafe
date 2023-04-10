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
        Schema::create('sold_taxes', function (Blueprint $table) {
            $table->foreignId('customer_id')->references('id')->on('customers');
            $table->foreignId('taxe_id')->references('id')->on('taxes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('sold_taxes');
    }
};