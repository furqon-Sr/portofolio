<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name', 'logo', 'url', 'order_index'];

    public static function seedIfEmpty(): void
    {
        if (static::count() > 0) {
            return;
        }

        $dummySvg = "data:image/svg+xml;base64," . base64_encode('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 60"><rect width="200" height="60" fill="#333" rx="8"/><text x="50%" y="50%" fill="#aaa" font-family="sans-serif" font-size="20" font-weight="bold" dominant-baseline="middle" text-anchor="middle">COMPANY</text></svg>');

        $clients = [
            ['name' => 'Acme Corp', 'logo' => $dummySvg, 'url' => '#', 'order_index' => 1],
            ['name' => 'Globex', 'logo' => $dummySvg, 'url' => '#', 'order_index' => 2],
            ['name' => 'Soylent', 'logo' => $dummySvg, 'url' => '#', 'order_index' => 3],
            ['name' => 'Initech', 'logo' => $dummySvg, 'url' => '#', 'order_index' => 4],
            ['name' => 'Umbrella', 'logo' => $dummySvg, 'url' => '#', 'order_index' => 5],
            ['name' => 'Stark Ind.', 'logo' => $dummySvg, 'url' => '#', 'order_index' => 6],
        ];

        foreach ($clients as $c) {
            static::create($c);
        }
    }
