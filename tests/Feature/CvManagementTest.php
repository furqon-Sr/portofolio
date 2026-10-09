<?php

use App\Models\AboutSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

beforeEach(function () {
    Storage::fake('public');
    Storage::fake('r2');
    AboutSetting::seedIfEmpty();
});

it('returns 404 when cv is not uploaded or has been deleted', function () {
    $setting = AboutSetting::first();
    $setting->update([
        'resume_link' => null,
    ]);

    $response = $this->get(route('cv.download'));
    $response->assertStatus(404);
});

it('serves active cv when resume_link is stored as base64', function () {
    $setting = AboutSetting::first();
    $sampleBase64 = 'data:application/pdf;base64,' . base64_encode('%PDF-1.4 sample content');
    $setting->update([
        'resume_link' => $sampleBase64,
    ]);

    $response = $this->get(route('cv.download'));
    $response->assertStatus(200);
    $response->assertHeader('Content-Type', 'application/pdf');
    expect($response->getContent())->toBe('%PDF-1.4 sample content');
});

it('redirects to external url when resume_link is an external url', function () {
    $setting = AboutSetting::first();
    $setting->update([
        'resume_link' => 'https://drive.google.com/file/d/sample/view',
    ]);

    $response = $this->get(route('cv.download'));
    $response->assertRedirect('https://drive.google.com/file/d/sample/view');
});

it('allows admin to remove cv and resets resume_link to null', function () {
    $user = User::factory()->create();
    $setting = AboutSetting::first();
    $setting->update([
        'resume_link' => 'data:application/pdf;base64,' . base64_encode('sample cv'),
        'hero_title' => 'John Doe',
        'hero_subtitle' => 'Fullstack Developer',
    ]);

    $response = $this->actingAs($user)
        ->put(route('admin.about.hero.update'), [
            'hero_title' => 'John Doe',
            'hero_subtitle' => 'Fullstack Developer',
            'remove_resume' => '1',
        ]);

    $response->assertRedirect(route('admin.about'))
        ->assertSessionHas('success');

    $setting->refresh();
    expect($setting->resume_link)->toBeNull();

    // Verify GET /cv returns 404 immediately after deletion
    $this->get(route('cv.download'))->assertStatus(404);
});

it('does not render download cv button in navigation and footer when resume_link is null', function () {
    $setting = AboutSetting::first();
    $setting->update([
        'resume_link' => null,
        'design_portfolio_pdf_path' => null,
    ]);

    $response = $this->get('/');
    $response->assertStatus(200)
        ->assertDontSee('Download CV');
});

it('renders download cv button when resume_link is configured', function () {
    $setting = AboutSetting::first();
    $setting->update([
        'resume_link' => 'https://example.com/cv.pdf',
        'design_portfolio_pdf_path' => null,
    ]);

    $response = $this->get('/');
    $response->assertStatus(200)
        ->assertSee('Download CV')
        ->assertSee(route('cv.download'));
});

it('renders dropdown with both cv and portfolio design when both are configured', function () {
    $setting = AboutSetting::first();
    $setting->update([
        'resume_link' => 'https://example.com/cv.pdf',
        'design_portfolio_pdf_path' => 'portfolios/design.pdf',
    ]);

    $response = $this->get('/');
    $response->assertStatus(200)
        ->assertSee('Download CV')
        ->assertSee('Portfolio Desain');
});
