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

it('renders custom article SEO metadata, keywords, and JSON-LD when provided', function () {
    $article = Article::create([
        'title' => 'Judul Standar Artikel',
        'slug' => 'judul-standar-artikel',
        'excerpt' => 'Excerpt standar artikel.',
        'content' => 'Konten lengkap artikel.',
        'meta_title' => 'Judul Kustom Khusus SEO Google',
        'meta_description' => 'Deskripsi kustom yang dioptimalkan untuk mesin pencari.',
        'meta_keywords' => 'laravel, seo, optimization, google',
    ]);

    $response = $this->get('/blog/' . $article->slug);

    $response->assertStatus(200)
        ->assertSee('<title>Judul Kustom Khusus SEO Google</title>', false)
        ->assertSee('<meta name="description" content="Deskripsi kustom yang dioptimalkan untuk mesin pencari.">', false)
        ->assertSee('<meta name="keywords" content="laravel, seo, optimization, google">', false)
        ->assertSee('property="og:title" content="Judul Kustom Khusus SEO Google"', false)
        ->assertSee('property="og:description" content="Deskripsi kustom yang dioptimalkan untuk mesin pencari."', false)
        ->assertSee('name="twitter:title" content="Judul Kustom Khusus SEO Google"', false)
        ->assertSee('"headline": "Judul Kustom Khusus SEO Google"', false)
        ->assertSee('"keywords": "laravel, seo, optimization, google"', false);
});

it('allows admin to update global SEO verification and web analytics settings', function () {
    $user = \App\Models\User::factory()->create();

    $response = $this->actingAs($user)->put(route('admin.about.seo.update'), [
        'google_site_verification' => 'test-google-token-12345',
        'cloudflare_analytics_token' => 'test-cf-beacon-token-67890',
        'google_analytics_id' => 'G-ABCDEF1234',
    ]);

    $response->assertRedirect(route('admin.about'))
        ->assertSessionHas('success');

    $setting = AboutSetting::first();
    expect($setting->google_site_verification)->toBe('test-google-token-12345')
        ->and($setting->cloudflare_analytics_token)->toBe('test-cf-beacon-token-67890')
        ->and($setting->google_analytics_id)->toBe('G-ABCDEF1234');

    // Public pages should now output the verification meta tag and analytics scripts
    $homeResponse = $this->get('/');
    $homeResponse->assertStatus(200)
        ->assertSee('<meta name="google-site-verification" content="test-google-token-12345"', false)
        ->assertSee('https://static.cloudflareinsights.com/beacon.min.js', false)
        ->assertSee('test-cf-beacon-token-67890', false)
        ->assertSee('https://www.googletagmanager.com/gtag/js?id=G-ABCDEF1234', false)
        ->assertSee("gtag('config', 'G-ABCDEF1234');", false);
});

it('persists and updates article SEO meta fields through admin routes', function () {
    $user = \App\Models\User::factory()->create();

    // Store new article with SEO metadata
    $storeResponse = $this->actingAs($user)->post(route('admin.articles.store'), [
        'title' => 'Panduan Desain Web 2026',
        'excerpt' => 'Ringkasan desain web modern.',
        'content' => 'Konten panduan desain web lengkap.',
        'meta_title' => 'Desain Web Modern 2026: Tips & Trik SEO',
        'meta_description' => 'Pelajari tren desain web 2026 yang ramah SEO dan cepat.',
        'meta_keywords' => 'ui/ux, web design, modern css',
    ]);

    $storeResponse->assertRedirect(route('admin.articles.index'))
        ->assertSessionHas('success');

    $article = Article::where('title', 'Panduan Desain Web 2026')->first();
    expect($article)->not->toBeNull()
        ->and($article->meta_title)->toBe('Desain Web Modern 2026: Tips & Trik SEO')
        ->and($article->meta_description)->toBe('Pelajari tren desain web 2026 yang ramah SEO dan cepat.')
        ->and($article->meta_keywords)->toBe('ui/ux, web design, modern css');

    // Update article SEO metadata
    $updateResponse = $this->actingAs($user)->put(route('admin.articles.update', $article->id), [
        'title' => 'Panduan Desain Web 2026 Updated',
        'excerpt' => 'Ringkasan diubah.',
        'content' => 'Konten diubah.',
        'meta_title' => 'Judul SEO Diperbarui',
        'meta_description' => 'Deskripsi SEO diperbarui.',
        'meta_keywords' => 'laravel, vue, modern web',
    ]);

    $updateResponse->assertRedirect(route('admin.articles.index'))
        ->assertSessionHas('success');

    $article->refresh();
    expect($article->meta_title)->toBe('Judul SEO Diperbarui')
        ->and($article->meta_description)->toBe('Deskripsi SEO diperbarui.')
        ->and($article->meta_keywords)->toBe('laravel, vue, modern web');
});
