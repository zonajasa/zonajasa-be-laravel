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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('kode_user')->unique();
            $table->foreignId('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreignId('account_level_id')->references('id')->on('account_levels')->onDelete('cascade');
            $table->boolean('status_account')->default(false);
            $table->boolean('status_service')->default(false);
            $table->string('full_name');
            $table->string('whatsapp')->unique();
            $table->string('password');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
