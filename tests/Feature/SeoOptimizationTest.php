<?php

use App\Models\AboutSetting;
use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    AboutSetting::seedIfEmpty();
});

it('serves dynamic sitemap.xml with xml content type and article urls', function () {
    $article = Article::create([
        'title' => 'Panduan SEO Laravel',
        'slug' => 'panduan-seo-laravel',
        'excerpt' => 'Artikel panduan optimasi SEO di Laravel.',
        'content' => 'Konten lengkap panduan SEO.',
    ]);

    $response = $this->get('/sitemap.xml');

    $response->assertStatus(200)
        ->assertHeader('Content-Type', 'application/xml; charset=utf-8')
        ->assertSee('<?xml version="1.0" encoding="UTF-8"?>', false)
        ->assertSee('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', false)
        ->assertSee(url('/'))
        ->assertSee(url('/works'))
        ->assertSee(url('/certificates'))
        ->assertSee(url('/blog'))
        ->assertSee(url('/contact'))
        ->assertSee(url('/blog/' . $article->slug));
});

it('contains correct sitemap and disallow directives in robots.txt', function () {
    $robotsPath = public_path('robots.txt');
    expect(file_exists($robotsPath))->toBeTrue();

    $content = file_get_contents($robotsPath);
    expect($content)->toContain('Sitemap: https://fahrurihanafi.site/sitemap.xml')
        ->and($content)->toContain('Disallow: /console-fh927')
        ->and($content)->toContain('Disallow: /api/');
});

it('renders complete SEO metadata and JSON-LD schema on homepage', function () {
    $response = $this->get('/');

    $response->assertStatus(200)
        ->assertSee('<meta name="description"', false)
        ->assertSee('property="og:title"', false)
        ->assertSee('property="og:description"', false)
        ->assertSee('name="twitter:card"', false)
        ->assertSee('@type": "Person"', false)
        ->assertSee('@type": "WebSite"', false);
});

it('renders complete Open Graph, Twitter Card, and BlogPosting schema on article page', function () {
    $article = Article::create([
        'title' => 'Optimasi Core Web Vitals',
        'slug' => 'optimasi-core-web-vitals',
        'excerpt' => 'Cara meningkatkan skor INP dan LCP.',
        'content' => 'Penjelasan teknis Core Web Vitals.',
        'cover_image' => 'https://example.com/cwv.png',
    ]);

    $response = $this->get('/blog/' . $article->slug);

    $response->assertStatus(200)
        ->assertSee('<meta name="description" content="Cara meningkatkan skor INP dan LCP.">', false)
        ->assertSee('property="og:type" content="article"', false)
        ->assertSee('property="og:title" content="Optimasi Core Web Vitals"', false)
        ->assertSee('property="og:image" content="https://example.com/cwv.png"', false)
        ->assertSee('name="twitter:card" content="summary_large_image"', false)
        ->assertSee('@type": "BlogPosting"', false)
        ->assertSee('"headline": "Optimasi Core Web Vitals"', false);
});
