<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->integer('device_id')->unique();
            $table->foreign('device_id')->references('number')->on('devices');
            $table->timestamp('from_time')->useCurrent();
            $table->time('reserved_time')->default("1:00:00");
            $table->boolean('is_open_time')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('customers');
    }
};
