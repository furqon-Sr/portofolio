<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSetting extends Model
{
    protected $fillable = [
        'about_text',
        'logo_type',
        'logo_value',
        'footer_name',
        'footer_copyright',
        'hero_title',
        'hero_subtitle',
        'favicon',
        'favicon_type',
        'profile_photo',
        'resume_link',
        'design_portfolio_pdf_path',
        'design_portfolio_pdf_name',
        'design_portfolio_pdf_size',
    ];

    /**
     * Check if design portfolio PDF exists.
     */
    public function getHasDesignPortfolioPdfAttribute(): bool
    {
        return !empty($this->design_portfolio_pdf_path);
    }

    /**
     * Get the public URL for the Graphic Design Portfolio PDF.
     */
    public function getDesignPortfolioPdfUrlAttribute(): ?string
    {
        if (empty($this->design_portfolio_pdf_path)) {
            return null;
        }

        $path = $this->design_portfolio_pdf_path;

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            if (str_contains($path, '.r2.dev/')) {
                $subPath = substr($path, strpos($path, '.r2.dev/') + 8);
                return url('/r2/' . $subPath);
            }
            return $path;
        }

        return route('portfolio.design.download');
    }

    /**
     * Get human-readable formatted file size for design portfolio PDF.
     */
    public function getDesignPortfolioPdfSizeFormattedAttribute(): ?string
    {
        $bytes = (int) ($this->design_portfolio_pdf_size ?? 0);
        if ($bytes <= 0) {
            return null;
        }

        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 1) . ' MB';
        }

        if ($bytes >= 1024) {
            return number_format($bytes / 1024, 0) . ' KB';
        }

        return $bytes . ' B';
    }

    /**
     * Seed default about settings if table is empty.
     */
    public static function seedIfEmpty(): void
    {
        if (static::count() > 0) {
            return;
        }

        static::create([
            'about_text' => 'I design and develop digital products focused on operational efficiency. Combining strict optical balance with maintainable code to deliver practical, logic-driven solutions.',
            'logo_type' => 'text',
            'logo_value' => 'HANAFI',
            'footer_name' => 'FAHRURI HANAFI',
            'footer_copyright' => '© 2026 Fahruri Hanafi. All rights reserved.',
            'hero_title' => 'Bridging the gap between optical balance and scalable architecture.',
            'hero_subtitle' => 'Product Designer & Fullstack Dev.',
            'favicon' => null,
            'favicon_type' => 'url',
        ]);
    }
}
