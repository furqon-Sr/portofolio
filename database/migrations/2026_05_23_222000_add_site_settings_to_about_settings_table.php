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
        Schema::table('about_settings', function (Blueprint $table) {
            $table->string('logo_type')->default('text');
            $table->text('logo_value')->nullable();
            $table->string('footer_name')->default('FAHRURI HANAFI');
            $table->text('footer_copyright')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_settings', function (Blueprint $table) {
            $table->dropColumn(['logo_type', 'logo_value', 'footer_name', 'footer_copyright']);
        });
    }
};
