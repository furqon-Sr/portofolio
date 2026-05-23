<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expertise extends Model
{
    protected $table = 'expertises';
    protected $fillable = ['name', 'url', 'logo', 'bg_class', 'hover_class'];

    /**
     * Seed default expertises if table is empty.
     */
    public static function seedIfEmpty(): void
    {
        if (static::count() > 0) {
            return;
        }

        $expertises = [
            [
                'name' => 'Laravel',
                'url' => 'https://laravel.com',
                'logo' => 'Laravel.jpg',
                'bg_class' => 'bg-[#FF2D20]/10',
                'hover_class' => 'hover:border-[#FF2D20]',
            ],
            [
                'name' => 'Node.js',
                'url' => 'https://nodejs.org',
                'logo' => 'nodejs.png',
                'bg_class' => 'bg-[#339933]/10',
                'hover_class' => 'hover:border-[#339933]',
            ],
            [
                'name' => 'JS',
                'url' => 'https://developer.mozilla.org',
                'logo' => 'javascript.png',
                'bg_class' => 'bg-white',
                'hover_class' => 'hover:border-[#F7DF1E]',
            ],
            [
                'name' => 'Java',
                'url' => 'https://www.java.com',
                'logo' => 'java.png',
                'bg_class' => 'bg-white',
                'hover_class' => 'hover:border-blue-500',
            ],
            [
                'name' => 'PHP',
                'url' => 'https://www.php.net',
                'logo' => 'php.png',
                'bg_class' => 'bg-[#777BB4]/10',
                'hover_class' => 'hover:border-[#777BB4]',
            ],
            [
                'name' => 'MySQL',
                'url' => 'https://www.mysql.com',
                'logo' => 'mysql.png',
                'bg_class' => 'bg-white',
                'hover_class' => 'hover:border-blue-500',
            ],
            [
                'name' => 'Figma',
                'url' => 'https://www.figma.com',
                'logo' => 'figma.png',
                'bg_class' => 'bg-[#F24E1E]/10',
                'hover_class' => 'hover:border-[#F24E1E]',
            ],
            [
                'name' => 'Tailwind',
                'url' => 'https://tailwindcss.com',
                'logo' => 'tailwindd.png',
                'bg_class' => 'bg-[#06B6D4]/10',
                'hover_class' => 'hover:border-[#06B6D4]',
            ],
            [
                'name' => 'Adobe AI',
                'url' => 'https://www.adobe.com/products/illustrator.html',
                'logo' => 'ai.svg',
                'bg_class' => 'bg-[#FF9A00]/10',
                'hover_class' => 'hover:border-[#FF9A00]',
            ],
            [
                'name' => 'Photoshop',
                'url' => 'https://www.adobe.com/products/photoshop.html',
                'logo' => 'ps.svg',
                'bg_class' => 'bg-[#31A8FF]/10',
                'hover_class' => 'hover:border-[#31A8FF]',
            ],
        ];

        foreach ($expertises as $exp) {
            static::create($exp);
        }
    }
}
