<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'description',
        'live_link',
        'cover_image',
        'design_file',
        'github_link',
        'gallery_assets',
        'views'
    ];
    protected $casts = [
        'gallery_assets' => 'array',
    ];

    /**
     * Check if project uses default PDF cover (like certificates).
     */
    public function getHasPdfCoverAttribute(): bool
    {
        $hasDesignPdf = !empty($this->design_file) || !empty($this->has_design_file);
        if (!$hasDesignPdf) {
            return false;
        }

        // If category is Design and cover image is either empty, placeholder, or set to pdf-default
        if (empty($this->cover_image) || in_array($this->cover_image, ['image.png', 'porto.png', 'pdf-default', 'pdf']) || str_ends_with(strtolower($this->cover_image), '.pdf')) {
            return true;
        }

        return false;
    }

    /**
     * Get the public URL for the project cover image.
     */
    public function getCoverImageUrlAttribute(): string
    {
        if ($this->has_pdf_cover) {
            return $this->design_pdf_url ?? asset('img/porto.png');
        }
        if (empty($this->cover_image)) {
            return asset('img/porto.png');
        }
        if (str_starts_with($this->cover_image, 'data:')) {
            return route('media.project.cover', [$this->id, 'v' => $this->updated_at?->timestamp ?? 1]);
        }
        if (str_starts_with($this->cover_image, 'http')) {
            return $this->cover_image;
        }
        return asset('img/' . ltrim($this->cover_image, '/'));
    }

    /**
     * Get the public URL for the design PDF document.
     */
    public function getDesignPdfUrlAttribute(): ?string
    {
        if (empty($this->design_file) && empty($this->has_design_file)) {
            return null;
        }
        if (str_starts_with($this->design_file, 'http')) {
            if (str_contains($this->design_file, '.r2.dev/')) {
                $path = substr($this->design_file, strpos($this->design_file, '.r2.dev/') + 8);
                return url('/r2/' . $path);
            }
            return $this->design_file;
        }
        return route('media.project.design', [$this->id, 'v' => $this->updated_at?->timestamp ?? 1]);
    }

    /**
     * Seed default projects if the database table is empty.
     */
    public static function seedIfEmpty(): void
    {
        if (static::count() > 0) {
            return;
        }

        $projects = [
            [
                'title' => 'ES Kristal Utama Indah',
                'slug' => 'es-kristal-utama-indah',
                'category' => 'Web Dev',
                'description' => 'Company profile & catalog website dengan desain profesional dan performa optimal.',
                'live_link' => 'https://eskristalutamaindah.com',
                'cover_image' => 'image.png',
                'github_link' => 'https://github.com/furqon-Sr/portofolio', // Default repo link
            ],
            [
                'title' => 'Media PPNK',
                'slug' => 'media-ppnk',
                'category' => 'Web Dev',
                'description' => 'Portal informasi dan platform media interaktif untuk PPNK.',
                'live_link' => 'https://mediappnk.org',
                'cover_image' => 'p.png',
                'github_link' => 'https://github.com/furqon-Sr/portofolio',
            ],
            [
                'title' => 'PDH Design System',
                'slug' => 'pdh-design-system',
                'category' => 'Design',
                'description' => 'Desain identitas visual menyeluruh dengan fokus pada keselarasan optik.',
                'live_link' => 'https://drive.google.com/file/d/1RCrTw1cJWoUGn10cs7VhrqkgtgQW4Ued/view?usp=sharing',
                'cover_image' => 'pdh.png',
                'github_link' => null,
            ],
            [
                'title' => 'FAPRE UNTAR',
                'slug' => 'fapre-untar',
                'category' => 'Design',
                'description' => 'Desain identitas visual untuk FAPRE UNTAR.',
                'live_link' => 'https://drive.google.com/file/d/1HKvCAHvM_LCVYvl5k4UkvYsxr944SyhO/view?usp=sharing',
                'cover_image' => 'fapre.png',
                'github_link' => null,
            ],
            [
                'title' => '170 th Anniversary cilacap Logo',
                'slug' => '170-th-anniversary-cilacap-logo',
                'category' => 'Design',
                'description' => 'Desain logo untuk peringatan 170 tahun Cilacap.',
                'live_link' => 'https://drive.google.com/file/d/1Kr7S5x2MlZWbB7na6PyV_oU6CKOEH55Y/view?usp=sharing',
                'cover_image' => 'cilacap.png',
                'github_link' => null,
            ],
            [
                'title' => 'karsa Coffee 360 Logo',
                'slug' => 'karsa-coffee-360-logo',
                'category' => 'Design',
                'description' => 'Desain logo untuk karsa kopi.',
                'live_link' => 'https://drive.google.com/file/d/1mVpGZqbPnMS9p9rrINu2QOVam5y8y5Vc/view?usp=sharing',
                'cover_image' => 'logo._1.png',
                'github_link' => null,
            ],
            [
                'title' => 'Pantai Baru Pandansimo Logo',
                'slug' => 'pantai-baru-pandansimo-logo',
                'category' => 'Design',
                'description' => 'Desain logo untuk Pantai Baru Pandansimo.',
                'live_link' => 'https://drive.google.com/file/d/1NI46cJsx0VGpNJeL2QuDTT93ofKTpd2g/view?usp=sharing',
                'cover_image' => 'pantai.png',
                'github_link' => null,
            ],
            [
                'title' => 'Es Kristal Utama Indah Logo',
                'slug' => 'es-kristal-utama-indah-logo',
                'category' => 'Design',
                'description' => 'Desain logo untuk Es Kristal Utama Indah.',
                'live_link' => 'https://drive.google.com/file/d/1OFPnrEakJhrV0yvWMQ7mWsZDJkJUoULf/view?usp=sharing',
                'cover_image' => 'ui.png',
                'github_link' => null,
            ],
            [
                'title' => 'Price List Coffee Shop',
                'slug' => 'price-list-coffee-shop',
                'category' => 'Design',
                'description' => 'Desain price list untuk Coffee Shop.',
                'live_link' => 'https://drive.google.com/file/d/13QaS42JbzoGoLD6lqFxtC5PTxPKEeN_O/view?usp=sharing',
                'cover_image' => 'pricelist.png',
                'github_link' => null,
            ],
        ];

        foreach ($projects as $proj) {
            static::create($proj);
        }
    }
}
