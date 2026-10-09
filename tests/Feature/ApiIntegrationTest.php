<?php

use App\Models\Article;
use App\Models\Certificate;
use App\Models\Contact;
use App\Models\Expertise;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

const TEST_API_KEY = 'test_gemini_api_key_12345';

it('rejects API requests without X-API-KEY header', function () {
    $response = $this->getJson('/api/contacts');

    $response->assertStatus(401)
        ->assertJson([
            'status' => 'error',
            'data' => null,
        ]);
});

it('rejects API requests with an invalid X-API-KEY header', function () {
    $response = $this->withHeaders(['X-API-KEY' => 'invalid-key-xyz'])
        ->getJson('/api/contacts');

    $response->assertStatus(401)
        ->assertJson([
            'status' => 'error',
            'data' => null,
        ]);
});

it('retrieves contacts successfully with valid X-API-KEY', function () {
    Contact::create([
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'message' => 'Halo, ini pesan pengujian.',
    ]);

    $response = $this->withHeaders(['X-API-KEY' => TEST_API_KEY])
        ->getJson('/api/contacts');

    $response->assertStatus(200)
        ->assertJsonStructure([
            'status',
            'message',
            'data' => [
                '*' => ['id', 'name', 'email', 'message', 'created_at', 'updated_at'],
            ],
        ])
        ->assertJson([
            'status' => 'success',
        ]);

    expect($response->json('data'))->toHaveCount(1);
    expect($response->json('data.0.name'))->toBe('John Doe');
});

it('retrieves portfolio projects successfully', function () {
    Project::create([
        'title' => 'E-Commerce Platform',
        'slug' => 'e-commerce-platform-test',
        'category' => 'Web Dev',
        'description' => 'Modern e-commerce platform.',
        'cover_image' => 'https://example.com/cover.png',
        'live_link' => 'https://example.com',
        'github_link' => 'https://github.com/example/ecommerce',
    ]);

    $response = $this->withHeaders(['X-API-KEY' => TEST_API_KEY])
        ->getJson('/api/projects');

    $response->assertStatus(200)
        ->assertJsonStructure([
            'status',
            'message',
            'data' => [
                '*' => ['id', 'title', 'slug', 'category', 'description'],
            ],
        ])
        ->assertJson([
            'status' => 'success',
        ]);

    expect($response->json('data'))->toHaveCount(1);
    expect($response->json('data.0.title'))->toBe('E-Commerce Platform');
});

it('validates project creation payload and returns consistent error format', function () {
    $response = $this->withHeaders(['X-API-KEY' => TEST_API_KEY])
        ->postJson('/api/projects', []);

    $response->assertStatus(422)
        ->assertJsonStructure([
            'status',
            'message',
            'data' => ['title', 'category', 'description'],
        ])
        ->assertJson([
            'status' => 'error',
        ]);
});

it('creates a new portfolio project with valid payload', function () {
    $payload = [
        'title' => 'AI Assistant Chatbot',
        'category' => 'Web Dev',
        'description' => 'Asisten pintar berbasis AI.',
        'live_link' => 'https://chatbot.example.com',
        'github_link' => 'https://github.com/example/chatbot',
        'cover_image_url' => 'https://example.com/chatbot-cover.jpg',
    ];

    $response = $this->withHeaders(['X-API-KEY' => TEST_API_KEY])
        ->postJson('/api/projects', $payload);

    $response->assertStatus(201)
        ->assertJsonStructure([
            'status',
            'message',
            'data' => ['id', 'title', 'slug', 'category', 'description', 'cover_image'],
        ])
        ->assertJson([
            'status' => 'success',
            'data' => [
                'title' => 'AI Assistant Chatbot',
                'category' => 'Web Dev',
                'cover_image' => 'https://example.com/chatbot-cover.jpg',
            ],
        ]);

    $this->assertDatabaseHas('projects', [
        'title' => 'AI Assistant Chatbot',
    ]);
});

it('retrieves certificates successfully', function () {
    Certificate::create([
        'name' => 'AWS Certified Cloud Practitioner',
        'issuer' => 'Amazon Web Services',
        'issued_at' => 'January 2026',
        'credential_id' => 'AWS-CCP-12345',
        'credential_url' => 'https://aws.amazon.com/verify/12345',
        'image' => 'https://example.com/aws-cert.png',
    ]);

    $response = $this->withHeaders(['X-API-KEY' => TEST_API_KEY])
        ->getJson('/api/certificates');

    $response->assertStatus(200)
        ->assertJsonStructure([
            'status',
            'message',
            'data' => [
                '*' => ['id', 'name', 'issuer', 'issued_at'],
            ],
        ])
        ->assertJson([
            'status' => 'success',
        ]);

    expect($response->json('data'))->toHaveCount(1);
    expect($response->json('data.0.name'))->toBe('AWS Certified Cloud Practitioner');
});

it('validates certificate creation payload', function () {
    $response = $this->withHeaders(['X-API-KEY' => TEST_API_KEY])
        ->postJson('/api/certificates', []);

    $response->assertStatus(422)
        ->assertJsonStructure([
            'status',
            'message',
            'data' => ['name', 'issuer', 'issued_at'],
        ])
        ->assertJson([
            'status' => 'error',
        ]);
});

it('creates a new certificate successfully', function () {
    $payload = [
        'name' => 'Google Cloud Associate Cloud Engineer',
        'issuer' => 'Google Cloud',
        'issued_at' => 'March 2026',
        'credential_id' => 'GCP-ACE-98765',
        'credential_url' => 'https://google.com/verify/98765',
        'image_url' => 'https://example.com/gcp-cert.png',
    ];

    $response = $this->withHeaders(['X-API-KEY' => TEST_API_KEY])
        ->postJson('/api/certificates', $payload);

    $response->assertStatus(201)
        ->assertJsonStructure([
            'status',
            'message',
            'data' => ['id', 'name', 'issuer', 'issued_at', 'image'],
        ])
        ->assertJson([
            'status' => 'success',
            'data' => [
                'name' => 'Google Cloud Associate Cloud Engineer',
                'issuer' => 'Google Cloud',
                'image' => 'https://example.com/gcp-cert.png',
            ],
        ]);

    $this->assertDatabaseHas('certificates', [
        'name' => 'Google Cloud Associate Cloud Engineer',
    ]);
});

it('rejects MCP requests without valid key', function () {
    $getRes = $this->getJson('/api/mcp');
    $getRes->assertStatus(401);

    $postRes = $this->postJson('/api/mcp', [
        'jsonrpc' => '2.0',
        'id' => 1,
        'method' => 'tools/list',
    ]);
    $postRes->assertStatus(401);
});

it('returns MCP online status via GET /api/mcp with key query param', function () {
    $response = $this->getJson('/api/mcp?key=' . TEST_API_KEY);

    $response->assertStatus(200)
        ->assertJson([
            'status' => 'online',
            'server' => 'portfolio-mcp-server',
            'protocolVersion' => '2024-11-05',
        ]);
});

it('handles MCP initialize via POST /api/mcp with header', function () {
    $response = $this->withHeaders(['X-API-KEY' => TEST_API_KEY])
        ->postJson('/api/mcp', [
            'jsonrpc' => '2.0',
            'id' => 1,
            'method' => 'initialize',
            'params' => [],
        ]);

    $response->assertStatus(200)
        ->assertJson([
            'jsonrpc' => '2.0',
            'id' => 1,
            'result' => [
                'protocolVersion' => '2024-11-05',
                'serverInfo' => [
                    'name' => 'portfolio-mcp-server',
                ],
            ],
        ]);
});

it('handles MCP tools/list via POST /api/mcp with URL key param', function () {
    $response = $this->postJson('/api/mcp?key=' . TEST_API_KEY, [
        'jsonrpc' => '2.0',
        'id' => 2,
        'method' => 'tools/list',
    ]);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'jsonrpc',
            'id',
            'result' => [
                'tools' => [
                    '*' => ['name', 'description', 'inputSchema'],
                ],
            ],
        ]);

    $toolNames = collect($response->json('result.tools'))->pluck('name');
    expect($toolNames)->toContain('get_contacts', 'get_projects', 'create_project', 'get_certificates', 'create_certificate');
});

it('executes MCP tool create_project via POST /api/mcp with auth', function () {
    $response = $this->withHeaders(['X-API-KEY' => TEST_API_KEY])
        ->postJson('/api/mcp', [
            'jsonrpc' => '2.0',
            'id' => 3,
            'method' => 'tools/call',
            'params' => [
                'name' => 'create_project',
                'arguments' => [
                    'title' => 'Project via MCP',
                    'category' => 'Web Dev',
                    'description' => 'Project created through Model Context Protocol.',
                ],
            ],
        ]);

    $response->assertStatus(200)
        ->assertJson([
            'jsonrpc' => '2.0',
            'id' => 3,
            'result' => [
                'isError' => false,
            ],
        ]);

    $this->assertDatabaseHas('projects', [
        'title' => 'Project via MCP',
    ]);
});

it('updates an existing portfolio project via PUT /api/projects/{id}', function () {
    $project = Project::create([
        'title' => 'Initial Title',
        'slug' => 'initial-title',
        'category' => 'Web Dev',
        'description' => 'Initial description.',
        'cover_image' => 'https://example.com/old.png',
    ]);

    $response = $this->withHeaders(['X-API-KEY' => TEST_API_KEY])
        ->putJson("/api/projects/{$project->id}", [
            'title' => 'Updated Project Title',
            'category' => 'Design',
            'live_link' => 'https://updated.example.com',
        ]);

    $response->assertStatus(200)
        ->assertJson([
            'status' => 'success',
            'message' => 'Portofolio berhasil diperbarui.',
            'data' => [
                'id' => $project->id,
                'title' => 'Updated Project Title',
                'category' => 'Design',
                'live_link' => 'https://updated.example.com',
            ],
        ]);

    $this->assertDatabaseHas('projects', [
        'id' => $project->id,
        'title' => 'Updated Project Title',
        'category' => 'Design',
    ]);
});

it('executes MCP tool update_project via POST /api/mcp', function () {
    $project = Project::create([
        'title' => 'Pre-MCP Project',
        'slug' => 'pre-mcp-project',
        'category' => 'Web Dev',
        'description' => 'Will be updated via MCP.',
        'cover_image' => 'https://example.com/cover.png',
    ]);

    $response = $this->withHeaders(['X-API-KEY' => TEST_API_KEY])
        ->postJson('/api/mcp', [
            'jsonrpc' => '2.0',
            'id' => 4,
            'method' => 'tools/call',
            'params' => [
                'name' => 'update_project',
                'arguments' => [
                    'id' => $project->id,
                    'title' => 'Updated via MCP Tool',
                    'description' => 'Description refreshed by Gemini Spark MCP.',
                ],
            ],
        ]);

    $response->assertStatus(200)
        ->assertJson([
            'jsonrpc' => '2.0',
            'id' => 4,
            'result' => [
                'isError' => false,
            ],
        ]);

    $this->assertDatabaseHas('projects', [
        'id' => $project->id,
        'title' => 'Updated via MCP Tool',
        'description' => 'Description refreshed by Gemini Spark MCP.',
    ]);
});

it('retrieves published articles successfully', function () {
    Article::create([
        'title' => 'Belajar Model Context Protocol',
        'slug' => 'belajar-model-context-protocol-1',
        'excerpt' => 'Panduan lengkap MCP untuk AI Agent.',
        'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        'cover_image' => 'https://example.com/cover.jpg',
        'references' => [
            ['title' => 'Anthropic MCP Spec', 'url' => 'https://modelcontextprotocol.io'],
        ],
    ]);

    $response = $this->withHeaders(['X-API-KEY' => TEST_API_KEY])
        ->getJson('/api/articles');

    $response->assertStatus(200)
        ->assertJson([
            'status' => 'success',
            'message' => 'Daftar artikel blog berhasil diambil.',
        ]);

    expect($response->json('data'))->toHaveCount(1);
    expect($response->json('data.0.title'))->toBe('Belajar Model Context Protocol');
});

it('creates an article successfully via REST API', function () {
    $payload = [
        'title' => 'Artikel Baru via REST API',
        'excerpt' => 'Ringkasan singkat artikel.',
        'content' => 'Konten lengkap artikel tentang integrasi AI.',
        'cover_image_url' => 'https://example.com/ai-blog.png',
        'cover_image_source' => 'Unsplash / Space AI',
        'cover_image_source_url' => 'https://unsplash.com/photos/space-ai',
        'references' => [
            ['title' => 'Laravel Documentation', 'url' => 'https://laravel.com/docs'],
        ],
    ];

    $response = $this->withHeaders(['X-API-KEY' => TEST_API_KEY])
        ->postJson('/api/articles', $payload);

    $response->assertStatus(201)
        ->assertJson([
            'status' => 'success',
            'message' => 'Artikel blog berhasil diterbitkan.',
            'data' => [
                'title' => 'Artikel Baru via REST API',
                'excerpt' => 'Ringkasan singkat artikel.',
                'cover_image_source' => 'Unsplash / Space AI',
                'cover_image_source_url' => 'https://unsplash.com/photos/space-ai',
            ],
        ]);

    $this->assertDatabaseHas('articles', [
        'title' => 'Artikel Baru via REST API',
        'cover_image_source' => 'Unsplash / Space AI',
        'cover_image_source_url' => 'https://unsplash.com/photos/space-ai',
    ]);
});

it('updates an existing article via PUT /api/articles/{id}', function () {
    $article = Article::create([
        'title' => 'Judul Awal',
        'slug' => 'judul-awal',
        'excerpt' => 'Excerpt lama.',
        'content' => 'Konten lama.',
        'cover_image' => 'https://example.com/old.png',
    ]);

    $response = $this->withHeaders(['X-API-KEY' => TEST_API_KEY])
        ->putJson("/api/articles/{$article->id}", [
            'title' => 'Judul Artikel Diperbarui',
            'content' => 'Konten artikel sudah direvisi.',
        ]);

    $response->assertStatus(200)
        ->assertJson([
            'status' => 'success',
            'message' => 'Artikel blog berhasil diperbarui.',
            'data' => [
                'id' => $article->id,
                'title' => 'Judul Artikel Diperbarui',
                'content' => 'Konten artikel sudah direvisi.',
            ],
        ]);

    $this->assertDatabaseHas('articles', [
        'id' => $article->id,
        'title' => 'Judul Artikel Diperbarui',
    ]);
});

it('executes MCP tool get_articles via POST /api/mcp', function () {
    Article::create([
        'title' => 'Artikel untuk MCP Test',
        'slug' => 'artikel-untuk-mcp-test',
        'excerpt' => 'Excerpt test.',
        'content' => 'Konten test.',
    ]);

    $response = $this->withHeaders(['X-API-KEY' => TEST_API_KEY])
        ->postJson('/api/mcp', [
            'jsonrpc' => '2.0',
            'id' => 5,
            'method' => 'tools/call',
            'params' => [
                'name' => 'get_articles',
                'arguments' => ['limit' => 5],
            ],
        ]);

    $response->assertStatus(200)
        ->assertJson([
            'jsonrpc' => '2.0',
            'id' => 5,
            'result' => [
                'isError' => false,
            ],
        ]);
});

it('executes MCP tool create_article via POST /api/mcp', function () {
    $response = $this->withHeaders(['X-API-KEY' => TEST_API_KEY])
        ->postJson('/api/mcp', [
            'jsonrpc' => '2.0',
            'id' => 6,
            'method' => 'tools/call',
            'params' => [
                'name' => 'create_article',
                'arguments' => [
                    'title' => 'Artikel Dibuat oleh Gemini Spark',
                    'excerpt' => 'Eksperimen integrasi MCP di website portofolio.',
                    'content' => 'Halo dunia! Artikel ini ditulis secara otomatis oleh AI Content Creator.',
                    'cover_image_url' => 'https://example.com/spark.png',
                    'references' => [
                        ['title' => 'Google Gemini', 'url' => 'https://ai.google.dev'],
                    ],
                ],
            ],
        ]);

    $response->assertStatus(200)
        ->assertJson([
            'jsonrpc' => '2.0',
            'id' => 6,
            'result' => [
                'isError' => false,
            ],
        ]);

    $this->assertDatabaseHas('articles', [
        'title' => 'Artikel Dibuat oleh Gemini Spark',
    ]);
});

it('executes MCP tool update_article via POST /api/mcp', function () {
    $article = Article::create([
        'title' => 'Draft Artikel',
        'slug' => 'draft-artikel',
        'excerpt' => 'Draft excerpt.',
        'content' => 'Draft content.',
    ]);

    $response = $this->withHeaders(['X-API-KEY' => TEST_API_KEY])
        ->postJson('/api/mcp', [
            'jsonrpc' => '2.0',
            'id' => 7,
            'method' => 'tools/call',
            'params' => [
                'name' => 'update_article',
                'arguments' => [
                    'id' => $article->id,
                    'title' => 'Artikel Telah Direview dan Dipublikasikan',
                    'content' => 'Versi final dari artikel ini telah diverifikasi.',
                ],
            ],
        ]);

    $response->assertStatus(200)
        ->assertJson([
            'jsonrpc' => '2.0',
            'id' => 7,
            'result' => [
                'isError' => false,
            ],
        ]);

    $this->assertDatabaseHas('articles', [
        'id' => $article->id,
        'title' => 'Artikel Telah Direview dan Dipublikasikan',
    ]);
});

it('renders article detail page with cover image and markdown inline images', function () {
    $article = Article::create([
        'title' => 'Artikel dengan Media Gambar',
        'slug' => 'artikel-dengan-media-gambar',
        'excerpt' => 'Artikel yang memiliki gambar pendukung.',
        'content' => "Berikut diagram arsitektur sistem:\n\n![Diagram Sistem](https://example.com/diagram.png)\n\nPenjelasan lebih lanjut.",
        'cover_image' => 'https://example.com/cover-art.jpg',
        'cover_image_source' => 'Unsplash / Tech Explorer',
        'cover_image_source_url' => 'https://unsplash.com/photos/tech-explorer',
    ]);

    $response = $this->get("/blog/{$article->slug}");

    $response->assertStatus(200);
    $response->assertSee('https://example.com/cover-art.jpg');
    $response->assertSee('Sumber Gambar:');
    $response->assertSee('Unsplash / Tech Explorer');
    $response->assertSee('<img src="https://example.com/diagram.png" alt="Diagram Sistem"', false);
    $response->assertSee('Salin link');
    $response->assertSee('Bagikan ke X');
    $response->assertSee('Bagikan ke LinkedIn');
    $response->assertSee('Bagikan ke WhatsApp');
    $response->assertSee('Bagikan artikel ini');
});

it('retrieves expertises successfully via GET /api/expertise', function () {
    Expertise::create([
        'name' => 'Vue.js',
        'url' => 'https://vuejs.org',
        'logo' => 'vue.png',
        'bg_class' => 'bg-[#42B883]/10',
        'hover_class' => 'hover:border-[#42B883]',
    ]);

    $response = $this->withHeaders(['X-API-KEY' => TEST_API_KEY])
        ->getJson('/api/expertise');

    $response->assertStatus(200)
        ->assertJson([
            'status' => 'success',
            'message' => 'Daftar keahlian berhasil diambil.',
        ]);

    expect($response->json('data'))->toHaveCount(1);
    expect($response->json('data.0.name'))->toBe('Vue.js');
});

it('creates a new expertise via POST /api/expertise', function () {
    $payload = [
        'name' => 'Docker',
        'url' => 'https://www.docker.com',
        'logo' => 'docker.svg',
        'bg_class' => 'bg-[#2496ED]/10',
        'hover_class' => 'hover:border-[#2496ED]',
    ];

    $response = $this->withHeaders(['X-API-KEY' => TEST_API_KEY])
        ->postJson('/api/expertise', $payload);

    $response->assertStatus(201)
        ->assertJson([
            'status' => 'success',
            'message' => 'Data keahlian berhasil ditambahkan.',
            'data' => [
                'name' => 'Docker',
                'url' => 'https://www.docker.com',
                'logo' => 'docker.svg',
            ],
        ]);

    $this->assertDatabaseHas('expertises', [
        'name' => 'Docker',
    ]);
});

it('updates an existing expertise via PUT /api/expertise/{id}', function () {
    $expertise = Expertise::create([
        'name' => 'React Initial',
        'url' => 'https://react.dev',
        'logo' => 'react.png',
        'bg_class' => 'bg-white',
        'hover_class' => 'hover:border-blue-500',
    ]);

    $response = $this->withHeaders(['X-API-KEY' => TEST_API_KEY])
        ->putJson("/api/expertise/{$expertise->id}", [
            'name' => 'React 19',
            'hover_class' => 'hover:border-[#61DAFB]',
        ]);

    $response->assertStatus(200)
        ->assertJson([
            'status' => 'success',
            'message' => 'Data keahlian berhasil diperbarui.',
            'data' => [
                'id' => $expertise->id,
                'name' => 'React 19',
                'hover_class' => 'hover:border-[#61DAFB]',
            ],
        ]);

    $this->assertDatabaseHas('expertises', [
        'id' => $expertise->id,
        'name' => 'React 19',
    ]);
});

it('deletes an existing expertise via DELETE /api/expertise/{id}', function () {
    $expertise = Expertise::create([
        'name' => 'Temporary Skill',
        'url' => 'https://example.com',
        'logo' => 'temp.png',
        'bg_class' => 'bg-white',
        'hover_class' => 'hover:border-blue-500',
    ]);

    $response = $this->withHeaders(['X-API-KEY' => TEST_API_KEY])
        ->deleteJson("/api/expertise/{$expertise->id}");

    $response->assertStatus(200)
        ->assertJson([
            'status' => 'success',
        ]);

    $this->assertDatabaseMissing('expertises', [
        'id' => $expertise->id,
    ]);
});

it('executes MCP tool get_expertise via POST /api/mcp', function () {
    Expertise::create([
        'name' => 'TypeScript',
        'url' => 'https://www.typescriptlang.org',
        'logo' => 'ts.png',
        'bg_class' => 'bg-[#3178C6]/10',
        'hover_class' => 'hover:border-[#3178C6]',
    ]);

    $response = $this->withHeaders(['X-API-KEY' => TEST_API_KEY])
        ->postJson('/api/mcp', [
            'jsonrpc' => '2.0',
            'id' => 10,
            'method' => 'tools/call',
            'params' => [
                'name' => 'get_expertise',
                'arguments' => ['limit' => 5],
            ],
        ]);

    $response->assertStatus(200)
        ->assertJson([
            'jsonrpc' => '2.0',
            'id' => 10,
            'result' => [
                'isError' => false,
            ],
        ]);
});

it('executes MCP tool create_expertise via POST /api/mcp', function () {
    $response = $this->withHeaders(['X-API-KEY' => TEST_API_KEY])
        ->postJson('/api/mcp', [
            'jsonrpc' => '2.0',
            'id' => 11,
            'method' => 'tools/call',
            'params' => [
                'name' => 'create_expertise',
                'arguments' => [
                    'name' => 'GraphQL',
                    'url' => 'https://graphql.org',
                    'logo' => 'graphql.svg',
                    'bg_class' => 'bg-[#E10098]/10',
                    'hover_class' => 'hover:border-[#E10098]',
                ],
            ],
        ]);

    $response->assertStatus(200)
        ->assertJson([
            'jsonrpc' => '2.0',
            'id' => 11,
            'result' => [
                'isError' => false,
            ],
        ]);

    $this->assertDatabaseHas('expertises', [
        'name' => 'GraphQL',
    ]);
});

it('executes MCP tool update_expertise via POST /api/mcp', function () {
    $expertise = Expertise::create([
        'name' => 'Rust Lang',
        'url' => 'https://www.rust-lang.org',
        'logo' => 'rust.png',
        'bg_class' => 'bg-white',
        'hover_class' => 'hover:border-black',
    ]);

    $response = $this->withHeaders(['X-API-KEY' => TEST_API_KEY])
        ->postJson('/api/mcp', [
            'jsonrpc' => '2.0',
            'id' => 12,
            'method' => 'tools/call',
            'params' => [
                'name' => 'update_expertise',
                'arguments' => [
                    'id' => $expertise->id,
                    'name' => 'Rust 2026 Edition',
                ],
            ],
        ]);

    $response->assertStatus(200)
        ->assertJson([
            'jsonrpc' => '2.0',
            'id' => 12,
            'result' => [
                'isError' => false,
            ],
        ]);

    $this->assertDatabaseHas('expertises', [
        'id' => $expertise->id,
        'name' => 'Rust 2026 Edition',
    ]);
});

it('executes MCP tool delete_expertise via POST /api/mcp', function () {
    $expertise = Expertise::create([
        'name' => 'Old Skill to Delete',
        'url' => 'https://example.com',
        'logo' => 'old.png',
        'bg_class' => 'bg-white',
        'hover_class' => 'hover:border-black',
    ]);

    $response = $this->withHeaders(['X-API-KEY' => TEST_API_KEY])
        ->postJson('/api/mcp', [
            'jsonrpc' => '2.0',
            'id' => 13,
            'method' => 'tools/call',
            'params' => [
                'name' => 'delete_expertise',
                'arguments' => [
                    'id' => $expertise->id,
                ],
            ],
        ]);

    $response->assertStatus(200)
        ->assertJson([
            'jsonrpc' => '2.0',
            'id' => 13,
            'result' => [
                'isError' => false,
            ],
        ]);

    $this->assertDatabaseMissing('expertises', [
        'id' => $expertise->id,
    ]);
});



