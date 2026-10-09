<?php

use App\Models\AboutSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

beforeEach(function () {
    Storage::fake('public');
    AboutSetting::seedIfEmpty();
});

it('prevents guests from uploading or deleting design portfolio pdf', function () {
    $file = UploadedFile::fake()->create('portfolio.pdf', 1000, 'application/pdf');

    $this->post(route('admin.portfolio.design-pdf.upload'), ['design_pdf_file' => $file])
        ->assertRedirect('/');

    $this->delete(route('admin.portfolio.design-pdf.delete'))
        ->assertRedirect('/');
});

it('validates that upload requires a valid PDF under 30MB', function () {
    $user = User::factory()->create();

    // Rejects non-pdf
    $txtFile = UploadedFile::fake()->create('doc.txt', 100, 'text/plain');
    $this->actingAs($user)
        ->post(route('admin.portfolio.design-pdf.upload'), ['design_pdf_file' => $txtFile])
        ->assertSessionHasErrors('design_pdf_file');

    // Rejects oversized file (> 30MB)
    $largePdf = UploadedFile::fake()->create('large.pdf', 31000, 'application/pdf');
    $this->actingAs($user)
        ->post(route('admin.portfolio.design-pdf.upload'), ['design_pdf_file' => $largePdf])
        ->assertSessionHasErrors('design_pdf_file');
});

it('allows admin to upload design portfolio pdf and updates about settings', function () {
    $user = User::factory()->create();
    $pdf = UploadedFile::fake()->create('graphic_design_portfolio.pdf', 1500, 'application/pdf');

    $response = $this->actingAs($user)
        ->post(route('admin.portfolio.design-pdf.upload'), [
            'design_pdf_file' => $pdf,
        ]);

    $response->assertRedirect()
        ->assertSessionHas('success');

    $setting = AboutSetting::first();
    expect($setting)->not->toBeNull()
        ->and($setting->has_design_portfolio_pdf)->toBeTrue()
        ->and($setting->design_portfolio_pdf_name)->toBe('graphic_design_portfolio.pdf')
        ->and($setting->design_portfolio_pdf_size)->toBeGreaterThan(0);
});

it('allows admin to delete design portfolio pdf and clears about settings', function () {
    $user = User::factory()->create();
    
    // Set setting with a file path
    $setting = AboutSetting::first();
    $setting->update([
        'design_portfolio_pdf_path' => 'portfolio/test.pdf',
        'design_portfolio_pdf_name' => 'test.pdf',
        'design_portfolio_pdf_size' => 1024,
    ]);

    $response = $this->actingAs($user)
        ->delete(route('admin.portfolio.design-pdf.delete'));

    $response->assertRedirect()
        ->assertSessionHas('success');

    $setting->refresh();
    expect($setting->design_portfolio_pdf_path)->toBeNull()
        ->and($setting->design_portfolio_pdf_name)->toBeNull()
        ->and($setting->design_portfolio_pdf_size)->toBeNull()
        ->and($setting->has_design_portfolio_pdf)->toBeFalse();
});

it('renders design portfolio download button dynamically on works page when file exists', function () {
    $setting = AboutSetting::first();
    $setting->update([
        'design_portfolio_pdf_path' => 'https://example.com/portfolio.pdf',
        'design_portfolio_pdf_name' => 'portfolio.pdf',
        'design_portfolio_pdf_size' => 2048576,
    ]);

    $response = $this->get('/works');
    $response->assertStatus(200)
        ->assertSee('Unduh Portfolio Desain (PDF)')
        ->assertSee(route('portfolio.design.download'));
});

it('does not render design portfolio download button when file is absent', function () {
    $setting = AboutSetting::first();
    $setting->update([
        'design_portfolio_pdf_path' => null,
        'design_portfolio_pdf_name' => null,
        'design_portfolio_pdf_size' => null,
    ]);

    $response = $this->get('/works');
    $response->assertStatus(200)
        ->assertDontSee('Unduh Portfolio Desain (PDF)');
});
