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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')->references('id')->on('devices')->onDelete('cascade');
            $table->uuid('kode_user')->unique();
            $table->string('nama_user')->nullable();
            $table->float('longitude', 10, 6)->nullable();
            $table->float('latitude', 10, 6)->nullable();
            $table->float('accuracy', 10, 6)->nullable();
            $table->float('speed', 10, 6)->nullable();
            $table->boolean('is_mock')->default(false)->nullable();
            $table->string('provider')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
