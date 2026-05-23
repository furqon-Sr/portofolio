<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSetting extends Model
{
    protected $fillable = ['about_text'];

    /**
     * Seed default about settings if table is empty.
     */
    public static function seedIfEmpty(): void
    {
        if (static::count() > 0) {
            return;
        }

        static::create([
            'about_text' => 'I design and develop digital products focused on operational efficiency. Combining strict optical balance with maintainable code to deliver practical, logic-driven solutions.'
        ]);
    }
}
