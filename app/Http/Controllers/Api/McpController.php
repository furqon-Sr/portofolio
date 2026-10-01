<?php

namespace App\Http\Controllers\Api;

use App\Models\Certificate;
use App\Models\Contact;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;

class McpController extends BaseApiController
{
    /**
     * Tool definitions for MCP tools/list
     */
    protected array $tools = [
        [
            'name' => 'get_contacts',
            'description' => 'Mengambil pesan masuk dari form kontak website portofolio.',
            'inputSchema' => [
                'type' => 'object',
                'properties' => [
                    'limit' => [
                        'type' => 'integer',
                        'description' => 'Jumlah maksimal pesan kontak yang ingin diambil (default: 50, max: 100).',
                    ],
                ],
            ],
        ],
        [
            'name' => 'get_projects',
            'description' => 'Melihat daftar proyek portofolio yang ada.',
            'inputSchema' => [
                'type' => 'object',
                'properties' => [
                    'category' => [
                        'type' => 'string',
                        'description' => "Filter kategori proyek (contoh: 'Web Dev' atau 'Design').",
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'description' => 'Jumlah maksimal proyek yang ingin diambil (default: 50).',
                    ],
                ],
            ],
        ],
        [
            'name' => 'create_project',
            'description' => 'Menambahkan entri portofolio baru ke website.',
            'inputSchema' => [
                'type' => 'object',
                'properties' => [
                    'title' => [
                        'type' => 'string',
                        'description' => 'Judul proyek portofolio (wajib).',
                    ],
                    'category' => [
                        'type' => 'string',
                        'description' => "Kategori proyek (contoh: 'Web Dev', 'Design') (wajib).",
                    ],
                    'description' => [
                        'type' => 'string',
                        'description' => 'Deskripsi lengkap mengenai proyek (wajib).',
                    ],
                    'live_link' => [
                        'type' => 'string',
                        'description' => 'URL demo atau website langsung (opsional).',
                    ],
                    'github_link' => [
                        'type' => 'string',
                        'description' => 'URL repositori GitHub (opsional).',
                    ],
                    'cover_image_url' => [
                        'type' => 'string',
                        'description' => 'URL gambar sampul (cover image) proyek (opsional).',
                    ],
                ],
                'required' => ['title', 'category', 'description'],
            ],
        ],
        [
            'name' => 'get_certificates',
            'description' => 'Mengambil daftar sertifikat yang terdaftar.',
            'inputSchema' => [
                'type' => 'object',
                'properties' => [
                    'limit' => [
                        'type' => 'integer',
                        'description' => 'Jumlah maksimal sertifikat yang ingin diambil (default: 50).',
                    ],
                ],
            ],
        ],
        [
            'name' => 'create_certificate',
            'description' => 'Menambahkan data sertifikat baru ke website.',
            'inputSchema' => [
                'type' => 'object',
                'properties' => [
                    'name' => [
                        'type' => 'string',
                        'description' => 'Nama atau judul sertifikat (wajib).',
                    ],
                    'issuer' => [
                        'type' => 'string',
                        'description' => "Penerbit sertifikat (misal: 'Google', 'Coursera', 'AWS') (wajib).",
                    ],
                    'issued_at' => [
                        'type' => 'string',
                        'description' => 'Tanggal atau periode penerbitan sertifikat (format: YYYY-MM-DD atau Bulan Tahun) (wajib).',
                    ],
                    'credential_id' => [
                        'type' => 'string',
                        'description' => 'ID kredensial sertifikat (opsional).',
                    ],
                    'credential_url' => [
                        'type' => 'string',
                        'description' => 'URL verifikasi kredensial (opsional).',
                    ],
                    'image_url' => [
                        'type' => 'string',
                        'description' => 'URL gambar sertifikat (opsional).',
                    ],
                ],
                'required' => ['name', 'issuer', 'issued_at'],
            ],
        ],
    ];

    /**
     * Handle MCP Request (GET, POST, OPTIONS)
     */
    public function handle(Request $request): mixed
    {
        // 1. OPTIONS preflight
        if ($request->isMethod('OPTIONS')) {
            return response('', 200, [
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET, POST, OPTIONS',
                'Access-Control-Allow-Headers' => 'Content-Type, Authorization, X-API-KEY, X-Session-Id',
            ]);
        }

        // 2. GET Request: SSE Transport or status
        if ($request->isMethod('GET')) {
            $acceptsSse = str_contains($request->header('Accept', ''), 'text/event-stream') ||
                          $request->query('transport') === 'sse';

            if ($acceptsSse) {
                $sessionId = $request->query('sessionId') ?: (string) Str::uuid();

                return new StreamedResponse(function () use ($sessionId) {
                    echo "event: endpoint\ndata: /api/mcp?sessionId={$sessionId}\n\n";
                    ob_flush();
                    flush();
                }, 200, [
                    'Content-Type' => 'text/event-stream',
                    'Cache-Control' => 'no-cache, no-transform',
                    'Connection' => 'keep-alive',
                    'X-Accel-Buffering' => 'no',
                    'Access-Control-Allow-Origin' => '*',
                ]);
            }

            return response()->json([
                'status' => 'online',
                'server' => 'portfolio-mcp-server',
                'version' => '1.0.0',
                'protocolVersion' => '2024-11-05',
                'transport' => ['sse', 'http-post'],
                'endpoints' => [
                    'sse' => '/api/mcp (Accept: text/event-stream)',
                    'post' => '/api/mcp',
                ],
                'tools' => array_map(fn ($t) => ['name' => $t['name'], 'description' => $t['description']], $this->tools),
            ], 200, ['Access-Control-Allow-Origin' => '*']);
        }

        // 3. POST Request: JSON-RPC 2.0
        $body = $request->json()->all();

        // Support batch or single JSON-RPC message
        $isBatch = array_is_list($body) && !empty($body);
        $messages = $isBatch ? $body : [$body];

        $responses = [];
        foreach ($messages as $msg) {
            $resp = $this->handleJsonRpc($msg);
            if ($resp !== null) {
                $responses[] = $resp;
            }
        }

        $final = $isBatch ? $responses : ($responses[0] ?? null);

        if ($final === null) {
            return response()->noContent(204, ['Access-Control-Allow-Origin' => '*']);
        }

        return response()->json($final, 200, ['Access-Control-Allow-Origin' => '*']);
    }

    /**
     * Process a single JSON-RPC message
     */
    protected function handleJsonRpc(array $msg): ?array
    {
        $id = $msg['id'] ?? null;
        $method = $msg['method'] ?? '';
        $params = $msg['params'] ?? [];
        $isNotification = !array_key_exists('id', $msg) || $msg['id'] === null;

        switch ($method) {
            case 'initialize':
                return [
                    'jsonrpc' => '2.0',
                    'id' => $id,
                    'result' => [
                        'protocolVersion' => '2024-11-05',
                        'capabilities' => [
                            'tools' => [
                                'listChanged' => false,
                            ],
                        ],
                        'serverInfo' => [
                            'name' => 'portfolio-mcp-server',
                            'version' => '1.0.0',
                        ],
                    ],
                ];

            case 'notifications/initialized':
                return null;

            case 'ping':
                return [
                    'jsonrpc' => '2.0',
                    'id' => $id,
                    'result' => new \stdClass(),
                ];

            case 'tools/list':
                return [
                    'jsonrpc' => '2.0',
                    'id' => $id,
                    'result' => [
                        'tools' => $this->tools,
                    ],
                ];

            case 'tools/call':
                $toolName = $params['name'] ?? '';
                $toolArgs = $params['arguments'] ?? [];

                try {
                    $result = $this->executeTool($toolName, $toolArgs);
                    return [
                        'jsonrpc' => '2.0',
                        'id' => $id,
                        'result' => [
                            'content' => [
                                [
                                    'type' => 'text',
                                    'text' => json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                                ],
                            ],
                            'isError' => false,
                        ],
                    ];
                } catch (\Throwable $e) {
                    return [
                        'jsonrpc' => '2.0',
                        'id' => $id,
                        'result' => [
                            'content' => [
                                [
                                    'type' => 'text',
                                    'text' => "Error executing tool '{$toolName}': " . $e->getMessage(),
                                ],
                            ],
                            'isError' => true,
                        ],
                    ];
                }

            default:
                if ($isNotification) {
                    return null;
                }
                return [
                    'jsonrpc' => '2.0',
                    'id' => $id,
                    'error' => [
                        'code' => -32601,
                        'message' => "Method '{$method}' tidak ditemukan pada MCP server.",
                    ],
                ];
        }
    }

    /**
     * Execute tool
     */
    protected function executeTool(string $name, array $args): mixed
    {
        switch ($name) {
            case 'get_contacts':
                $limit = min(max((int) ($args['limit'] ?? 50), 1), 100);
                return Contact::latest()->take($limit)->get();

            case 'get_projects':
                $query = Project::query();
                if (!empty($args['category'])) {
                    $query->where('category', $args['category']);
                }
                $limit = min(max((int) ($args['limit'] ?? 50), 1), 100);
                return $query->latest()->take($limit)->get();

            case 'create_project':
                $title = $args['title'] ?? 'Untitled';
                return Project::create([
                    'title' => $title,
                    'slug' => Str::slug($title) . '-' . time() . '-' . Str::random(4),
                    'category' => $args['category'] ?? 'Web Dev',
                    'description' => $args['description'] ?? '',
                    'live_link' => $args['live_link'] ?? null,
                    'github_link' => $args['github_link'] ?? null,
                    'cover_image' => $args['cover_image_url'] ?? 'image.png',
                ]);

            case 'get_certificates':
                $limit = min(max((int) ($args['limit'] ?? 50), 1), 100);
                return Certificate::latest()->take($limit)->get();

            case 'create_certificate':
                return Certificate::create([
                    'name' => $args['name'],
                    'issuer' => $args['issuer'],
                    'issued_at' => $args['issued_at'],
                    'credential_id' => $args['credential_id'] ?? null,
                    'credential_url' => $args['credential_url'] ?? null,
                    'image' => $args['image_url'] ?? 'cert.png',
                ]);

            default:
                throw new \InvalidArgumentException("Tool '{$name}' tidak dikenal.");
        }
    }
}
