<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutBox extends Model
{
    protected $fillable = ['key', 'title', 'description'];

    /**
     * Seed default about boxes if table is empty.
     */
    public static function seedIfEmpty(): void
    {
        if (static::count() > 0) {
            return;
        }

        $boxes = [
            [
                'key' => 'box_1',
                'title' => 'Agency Founder',
                'description' => 'NEXA Digital for high-end clients.'
            ],
            [
                'key' => 'box_2',
                'title' => 'Informatics Eng.',
                'description' => 'Strong logic & architecture.'
            ],
            [
                'key' => 'box_3',
                'title' => 'Business Ops',
                'description' => 'Retail & systems efficiency.'
            ],
            [
                'key' => 'box_4',
                'title' => 'Optical Precision',
                'description' => 'Zero-pixel drift design.'
            ],
        ];

        foreach ($boxes as $box) {
            static::create($box);
        }
    }
}
