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
        Schema::table('articles', function (Blueprint $table) {
            $table->string('meta_title')->nullable()->after('excerpt');
            $table->text('meta_description')->nullable()->after('meta_title');
            $table->string('meta_keywords')->nullable()->after('meta_description');
        });

        Schema::table('about_settings', function (Blueprint $table) {
            $table->string('google_site_verification')->nullable()->after('resume_link');
            $table->string('cloudflare_analytics_token')->nullable()->after('google_site_verification');
            $table->string('google_analytics_id')->nullable()->after('cloudflare_analytics_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['meta_title', 'meta_description', 'meta_keywords']);
        });

        Schema::table('about_settings', function (Blueprint $table) {
            $table->dropColumn(['google_site_verification', 'cloudflare_analytics_token', 'google_analytics_id']);
        });
    }
};
