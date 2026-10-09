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
            $table->text('design_portfolio_pdf_path')->nullable()->after('resume_link');
            $table->string('design_portfolio_pdf_name')->nullable()->after('design_portfolio_pdf_path');
            $table->unsignedBigInteger('design_portfolio_pdf_size')->nullable()->after('design_portfolio_pdf_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_settings', function (Blueprint $table) {
            $table->dropColumn([
                'design_portfolio_pdf_path',
                'design_portfolio_pdf_name',
                'design_portfolio_pdf_size',
            ]);
        });
    }
};
