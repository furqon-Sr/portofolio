<?php

use App\Models\Certificate;
use App\Models\Contact;
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

