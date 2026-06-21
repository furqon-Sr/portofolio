<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'name',
        'issuer',
        'issued_at',
        'credential_id',
        'credential_url',
        'image'
    ];

    /**
     * Seed default certificates if the database table is empty.
     */
    public static function seedIfEmpty(): void
    {
        if (static::count() > 0) {
            return;
        }

        $certificates = [
            [
                'name' => 'Google UX Design Professional Certificate',
                'issuer' => 'Google / Coursera',
                'issued_at' => 'June 2025',
                'credential_id' => 'G-UXD-98231',
                'credential_url' => 'https://coursera.org/verify/google-ux-design',
                'image' => 'cert.png',
            ],
            [
                'name' => 'AWS Certified Cloud Practitioner',
                'issuer' => 'Amazon Web Services (AWS)',
                'issued_at' => 'October 2025',
                'credential_id' => 'AWS-CCP-87214',
                'credential_url' => 'https://aws.amazon.com/verification',
                'image' => 'cert.png',
            ],
            [
                'name' => 'Laravel Certified Developer',
                'issuer' => 'Laravel Foundation',
                'issued_at' => 'March 2026',
                'credential_id' => 'LARAVEL-CERT-44122',
                'credential_url' => 'https://certification.laravel.com/verify/44122',
                'image' => 'cert.png',
            ],
        ];

        foreach ($certificates as $cert) {
            static::create($cert);
        }
    }
}
