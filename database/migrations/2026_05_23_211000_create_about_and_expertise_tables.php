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
        Schema::create('about_settings', function (Blueprint $table) {
            $table->id();
            $table->text('about_text');
            $table->timestamps();
        });

        Schema::create('about_boxes', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('title');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('expertises', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url')->nullable();
            $table->text('logo'); // Storing file path (e.g. Laravel.jpg) or base64 data
            $table->string('bg_class')->default('bg-white');
            $table->string('hover_class')->default('hover:border-blue-500');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expertises');
        Schema::dropIfExists('about_boxes');
        Schema::dropIfExists('about_settings');
    }
};
