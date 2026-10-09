<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use App\Models\Certificate;
use App\Models\Contact;
use App\Models\Expertise;
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
            'name' => 'update_project',
            'description' => 'Memperbarui data proyek portofolio yang sudah ada berdasarkan ID.',
            'inputSchema' => [
                'type' => 'object',
                'properties' => [
                    'id' => [
                        'type' => 'integer',
                        'description' => 'ID proyek portofolio yang ingin diperbarui (wajib).',
                    ],
                    'title' => [
                        'type' => 'string',
                        'description' => 'Judul baru proyek portofolio (opsional).',
                    ],
                    'category' => [
                        'type' => 'string',
                        'description' => "Kategori baru proyek (contoh: 'Web Dev', 'Design') (opsional).",
                    ],
                    'description' => [
                        'type' => 'string',
                        'description' => 'Deskripsi baru mengenai proyek (opsional).',
                    ],
                    'live_link' => [
                        'type' => 'string',
                        'description' => 'URL demo atau website baru (opsional).',
                    ],
                    'github_link' => [
                        'type' => 'string',
                        'description' => 'URL repositori GitHub baru (opsional).',
                    ],
                    'cover_image_url' => [
                        'type' => 'string',
                        'description' => 'URL gambar sampul (cover image) baru (opsional).',
                    ],
                ],
                'required' => ['id'],
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
        [
            'name' => 'get_articles',
            'description' => 'Melihat daftar artikel blog yang sudah terbit di website.',
            'inputSchema' => [
                'type' => 'object',
                'properties' => [
                    'limit' => [
                        'type' => 'integer',
                        'description' => 'Jumlah maksimal artikel yang ingin diambil (default: 50).',
                    ],
                ],
            ],
        ],
        [
            'name' => 'create_article',
            'description' => 'Membuat dan menerbitkan artikel blog baru ke website portofolio, lengkap dengan konten, gambar cover, referensi, dan metadata SEO.',
            'inputSchema' => [
                'type' => 'object',
                'properties' => [
                    'title' => [
                        'type' => 'string',
                        'description' => 'Judul artikel blog (wajib).',
                    ],
                    'content' => [
                        'type' => 'string',
                        'description' => 'Isi lengkap teks artikel blog (wajib, mendukung paragraf/teks/Markdown/HTML).',
                    ],
                    'excerpt' => [
                        'type' => 'string',
                        'description' => 'Ringkasan singkat artikel untuk preview (1-2 kalimat) (opsional).',
                    ],
                    'meta_title' => [
                        'type' => 'string',
                        'description' => 'Judul kustom khusus SEO untuk hasil pencarian Google (~60 karakter) (opsional).',
                    ],
                    'meta_description' => [
                        'type' => 'string',
                        'description' => 'Deskripsi ringkasan cuplikan khusus SEO Google (~160 karakter) (opsional).',
                    ],
                    'meta_keywords' => [
                        'type' => 'string',
                        'description' => 'Kata kunci SEO relevan dipisahkan koma, misal: "laravel, web development, ui design" (opsional).',
                    ],
                    'cover_image_url' => [
                        'type' => 'string',
                        'description' => 'URL gambar sampul (cover image) artikel (opsional).',
                    ],
                    'cover_image_source' => [
                        'type' => 'string',
                        'description' => 'Nama/label sumber kredit gambar (contoh: "Unsplash / SpaceX", "Dokumentasi Resmi") (opsional).',
                    ],
                    'cover_image_source_url' => [
                        'type' => 'string',
                        'description' => 'URL langsung ke halaman sumber gambar asli (opsional).',
                    ],
                    'references' => [
                        'type' => 'array',
                        'description' => 'Daftar referensi/jurnal/tautan sumber rujukan (opsional).',
                        'items' => [
                            'type' => 'object',
                            'properties' => [
                                'title' => ['type' => 'string', 'description' => 'Judul referensi'],
                                'url' => ['type' => 'string', 'description' => 'URL sumber rujukan'],
                            ],
                            'required' => ['title', 'url'],
                        ],
                    ],
                ],
                'required' => ['title', 'content'],
            ],
        ],
        [
            'name' => 'update_article',
            'description' => 'Memperbarui artikel blog yang sudah ada berdasarkan ID, termasuk konten dan metadata SEO.',
            'inputSchema' => [
                'type' => 'object',
                'properties' => [
                    'id' => [
                        'type' => 'integer',
                        'description' => 'ID artikel yang ingin diperbarui (wajib).',
                    ],
                    'title' => [
                        'type' => 'string',
                        'description' => 'Judul baru artikel blog (opsional).',
                    ],
                    'content' => [
                        'type' => 'string',
                        'description' => 'Isi teks baru artikel blog (opsional).',
                    ],
                    'excerpt' => [
                        'type' => 'string',
                        'description' => 'Ringkasan preview baru artikel (opsional).',
                    ],
                    'meta_title' => [
                        'type' => 'string',
                        'description' => 'Judul kustom baru khusus SEO Google (~60 karakter) (opsional).',
                    ],
                    'meta_description' => [
                        'type' => 'string',
                        'description' => 'Deskripsi ringkasan cuplikan baru khusus SEO Google (~160 karakter) (opsional).',
                    ],
                    'meta_keywords' => [
                        'type' => 'string',
                        'description' => 'Kata kunci SEO baru dipisahkan koma (opsional).',
                    ],
                    'cover_image_url' => [
                        'type' => 'string',
                        'description' => 'URL gambar sampul baru artikel (opsional).',
                    ],
                    'cover_image_source' => [
                        'type' => 'string',
                        'description' => 'Nama/label sumber kredit gambar baru (opsional).',
                    ],
                    'cover_image_source_url' => [
                        'type' => 'string',
                        'description' => 'URL langsung ke halaman sumber gambar asli yang baru (opsional).',
                    ],
                    'references' => [
                        'type' => 'array',
                        'description' => 'Daftar referensi baru (opsional).',
                        'items' => [
                            'type' => 'object',
                            'properties' => [
                                'title' => ['type' => 'string', 'description' => 'Judul referensi'],
                                'url' => ['type' => 'string', 'description' => 'URL sumber rujukan'],
                            ],
                            'required' => ['title', 'url'],
                        ],
                    ],
                ],
                'required' => ['id'],
            ],
        ],
        [
            'name' => 'update_article_seo',
            'description' => 'Mengoptimalkan atau memperbarui metadata SEO (meta_title, meta_description, meta_keywords) untuk artikel blog berdasarkan ID.',
            'inputSchema' => [
                'type' => 'object',
                'properties' => [
                    'id' => [
                        'type' => 'integer',
                        'description' => 'ID artikel blog yang ingin dioptimasi SEO-nya (wajib).',
                    ],
                    'meta_title' => [
                        'type' => 'string',
                        'description' => 'Judul kustom khusus SEO Google (~60 karakter) (opsional).',
                    ],
                    'meta_description' => [
                        'type' => 'string',
                        'description' => 'Deskripsi ringkasan cuplikan khusus SEO Google (~160 karakter) (opsional).',
                    ],
                    'meta_keywords' => [
                        'type' => 'string',
                        'description' => 'Kata kunci SEO relevan dipisahkan koma (contoh: "web design, laravel, ui/ux") (opsional).',
                    ],
                ],
                'required' => ['id'],
            ],
        ],
        [
            'name' => 'get_expertise',
            'description' => 'Mengambil daftar keahlian/expertise teknologi dan tools yang ada di website portofolio.',
            'inputSchema' => [
                'type' => 'object',
                'properties' => [
                    'limit' => [
                        'type' => 'integer',
                        'description' => 'Jumlah maksimal data keahlian yang ingin diambil (opsional).',
                    ],
                ],
            ],
        ],
        [
            'name' => 'create_expertise',
            'description' => 'Menambahkan data keahlian/expertise baru ke website portofolio.',
            'inputSchema' => [
                'type' => 'object',
                'properties' => [
                    'name' => [
                        'type' => 'string',
                        'description' => 'Nama keahlian atau teknologi (wajib, contoh: "React", "Docker", "Python").',
                    ],
                    'url' => [
                        'type' => 'string',
                        'description' => 'Tautan URL resmi teknologi (opsional).',
                    ],
                    'logo' => [
                        'type' => 'string',
                        'description' => 'Nama berkas logo (misal: "react.png") atau URL gambar logo (opsional, default: "code.svg").',
                    ],
                    'bg_class' => [
                        'type' => 'string',
                        'description' => 'Class warna latar belakang Tailwind (opsional, contoh: "bg-[#61DAFB]/10", default: "bg-white").',
                    ],
                    'hover_class' => [
                        'type' => 'string',
                        'description' => 'Class warna border saat hover Tailwind (opsional, contoh: "hover:border-[#61DAFB]", default: "hover:border-blue-500").',
                    ],
                ],
                'required' => ['name'],
            ],
        ],
        [
            'name' => 'update_expertise',
            'description' => 'Memperbarui data keahlian/expertise yang sudah ada berdasarkan ID.',
            'inputSchema' => [
                'type' => 'object',
                'properties' => [
                    'id' => [
                        'type' => 'integer',
                        'description' => 'ID data keahlian yang ingin diperbarui (wajib).',
                    ],
                    'name' => [
                        'type' => 'string',
                        'description' => 'Nama keahlian atau teknologi baru (opsional).',
                    ],
                    'url' => [
                        'type' => 'string',
                        'description' => 'Tautan URL resmi baru (opsional).',
                    ],
                    'logo' => [
                        'type' => 'string',
                        'description' => 'Nama berkas logo atau URL gambar baru (opsional).',
                    ],
                    'bg_class' => [
                        'type' => 'string',
                        'description' => 'Class latar belakang Tailwind baru (opsional).',
                    ],
                    'hover_class' => [
                        'type' => 'string',
                        'description' => 'Class border hover Tailwind baru (opsional).',
                    ],
                ],
                'required' => ['id'],
            ],
        ],
        [
            'name' => 'delete_expertise',
            'description' => 'Menghapus data keahlian/expertise dari website berdasarkan ID.',
            'inputSchema' => [
                'type' => 'object',
                'properties' => [
                    'id' => [
                        'type' => 'integer',
                        'description' => 'ID data keahlian yang ingin dihapus (wajib).',
                    ],
                ],
                'required' => ['id'],
            ],
        ],
    ];

    /**
     * Validate MCP client authentication against GEMINI_API_KEY / PORTFOLIO_API_KEY
     * Supports: X-API-KEY header, Authorization: Bearer <key>, or query param ?key=... / ?api_key=...
     */
    protected function isAuthorized(Request $request): bool
    {
        $serverKey = env('GEMINI_API_KEY') ?: env('PORTFOLIO_API_KEY');

        if (empty($serverKey)) {
            return false;
        }

        // 1. Check X-API-KEY header
        $providedKey = $request->header('X-API-KEY');

        // 2. Check Authorization: Bearer <key>
        if (empty($providedKey)) {
            $providedKey = $request->bearerToken();
        }

        // 3. Check query parameter: ?key=... or ?api_key=...
        if (empty($providedKey)) {
            $providedKey = $request->query('key') ?: $request->query('api_key');
        }

        if (empty($providedKey)) {
            return false;
        }

        return hash_equals((string) $serverKey, (string) $providedKey);
    }

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

        // 2. Enforce Authentication
        if (!$this->isAuthorized($request)) {
            if ($request->isMethod('POST')) {
                $id = $request->json('id');
                return response()->json([
                    'jsonrpc' => '2.0',
                    'id' => $id,
                    'error' => [
                        'code' => -32000,
                        'message' => 'Unauthorized. Kunci autentikasi tidak valid atau tidak disertakan. Sertakan header X-API-KEY, Bearer token, atau parameter URL ?key=.',
                    ],
                ], 401, ['Access-Control-Allow-Origin' => '*']);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized. Kunci autentikasi tidak valid atau tidak disertakan. Sertakan header X-API-KEY, Bearer token, atau parameter URL ?key=.',
                'data' => null,
            ], 401, ['Access-Control-Allow-Origin' => '*']);
        }

        // 3. GET Request: SSE Transport or status
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

            case 'update_project':
                $id = $args['id'] ?? null;
                if (!$id) {
                    throw new \InvalidArgumentException("Parameter 'id' wajib disertakan.");
                }

                $project = Project::find($id);
                if (!$project) {
                    throw new \InvalidArgumentException("Proyek portofolio dengan ID {$id} tidak ditemukan.");
                }

                $updateData = [];
                if (isset($args['title'])) {
                    $updateData['title'] = $args['title'];
                    $updateData['slug'] = Str::slug($args['title']) . '-' . $project->id;
                }
                if (isset($args['category'])) {
                    $updateData['category'] = $args['category'];
                }
                if (isset($args['description'])) {
                    $updateData['description'] = $args['description'];
                }
                if (array_key_exists('live_link', $args)) {
                    $updateData['live_link'] = $args['live_link'];
                }
                if (array_key_exists('github_link', $args)) {
                    $updateData['github_link'] = $args['github_link'];
                }
                if (!empty($args['cover_image_url'])) {
                    $updateData['cover_image'] = $args['cover_image_url'];
                }

                $project->update($updateData);
                return $project->fresh();

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

            case 'get_articles':
                $limit = min(max((int) ($args['limit'] ?? 50), 1), 100);
                return Article::latest()->take($limit)->get();

            case 'create_article':
                $title = $args['title'] ?? 'Untitled Article';
                $references = $args['references'] ?? [];
                return Article::create([
                    'title' => $title,
                    'excerpt' => $args['excerpt'] ?? null,
                    'content' => $args['content'] ?? '',
                    'cover_image' => $args['cover_image_url'] ?? null,
                    'cover_image_source' => $args['cover_image_source'] ?? null,
                    'cover_image_source_url' => $args['cover_image_source_url'] ?? null,
                    'references' => is_array($references) ? array_values($references) : [],
                    'meta_title' => $args['meta_title'] ?? null,
                    'meta_description' => $args['meta_description'] ?? null,
                    'meta_keywords' => $args['meta_keywords'] ?? null,
                ]);

            case 'update_article':
                $id = $args['id'] ?? null;
                if (!$id) {
                    throw new \InvalidArgumentException("Parameter 'id' wajib disertakan.");
                }

                $article = Article::find($id);
                if (!$article) {
                    throw new \InvalidArgumentException("Artikel blog dengan ID {$id} tidak ditemukan.");
                }

                $updateData = [];
                if (isset($args['title'])) {
                    $updateData['title'] = $args['title'];
                    $updateData['slug'] = Str::slug($args['title']) . '-' . $article->id;
                }
                if (isset($args['excerpt'])) {
                    $updateData['excerpt'] = $args['excerpt'];
                }
                if (isset($args['content'])) {
                    $updateData['content'] = $args['content'];
                }
                if (!empty($args['cover_image_url'])) {
                    $updateData['cover_image'] = $args['cover_image_url'];
                }
                if (array_key_exists('cover_image_source', $args)) {
                    $updateData['cover_image_source'] = $args['cover_image_source'];
                }
                if (array_key_exists('cover_image_source_url', $args)) {
                    $updateData['cover_image_source_url'] = $args['cover_image_source_url'];
                }
                if (isset($args['references']) && is_array($args['references'])) {
                    $updateData['references'] = array_values($args['references']);
                }
                if (array_key_exists('meta_title', $args)) {
                    $updateData['meta_title'] = $args['meta_title'];
                }
                if (array_key_exists('meta_description', $args)) {
                    $updateData['meta_description'] = $args['meta_description'];
                }
                if (array_key_exists('meta_keywords', $args)) {
                    $updateData['meta_keywords'] = $args['meta_keywords'];
                }

                $article->update($updateData);
                return $article->fresh();

            case 'update_article_seo':
                $id = $args['id'] ?? null;
                if (!$id) {
                    throw new \InvalidArgumentException("Parameter 'id' wajib disertakan.");
                }

                $article = Article::find($id);
                if (!$article) {
                    throw new \InvalidArgumentException("Artikel blog dengan ID {$id} tidak ditemukan.");
                }

                $updateData = [];
                if (array_key_exists('meta_title', $args)) {
                    $updateData['meta_title'] = $args['meta_title'];
                }
                if (array_key_exists('meta_description', $args)) {
                    $updateData['meta_description'] = $args['meta_description'];
                }
                if (array_key_exists('meta_keywords', $args)) {
                    $updateData['meta_keywords'] = $args['meta_keywords'];
                }

                $article->update($updateData);
                return $article->fresh();

            case 'get_expertise':
                $query = Expertise::orderBy('id', 'asc');
                if (!empty($args['limit'])) {
                    $limit = min(max((int) $args['limit'], 1), 100);
                    $query->take($limit);
                }
                return $query->get();

            case 'create_expertise':
                return Expertise::create([
                    'name' => $args['name'],
                    'url' => $args['url'] ?? null,
                    'logo' => $args['logo'] ?? 'code.svg',
                    'bg_class' => $args['bg_class'] ?? 'bg-white',
                    'hover_class' => $args['hover_class'] ?? 'hover:border-blue-500',
                ]);

            case 'update_expertise':
                $id = $args['id'] ?? null;
                if (!$id) {
                    throw new \InvalidArgumentException("Parameter 'id' wajib disertakan.");
                }

                $expertise = Expertise::find($id);
                if (!$expertise) {
                    throw new \InvalidArgumentException("Data keahlian dengan ID {$id} tidak ditemukan.");
                }

                $updateData = [];
                if (isset($args['name'])) {
                    $updateData['name'] = $args['name'];
                }
                if (array_key_exists('url', $args)) {
                    $updateData['url'] = $args['url'];
                }
                if (isset($args['logo'])) {
                    $updateData['logo'] = $args['logo'];
                }
                if (isset($args['bg_class'])) {
                    $updateData['bg_class'] = $args['bg_class'];
                }
                if (isset($args['hover_class'])) {
                    $updateData['hover_class'] = $args['hover_class'];
                }

                $expertise->update($updateData);
                return $expertise->fresh();

            case 'delete_expertise':
                $id = $args['id'] ?? null;
                if (!$id) {
                    throw new \InvalidArgumentException("Parameter 'id' wajib disertakan.");
                }

                $expertise = Expertise::find($id);
                if (!$expertise) {
                    throw new \InvalidArgumentException("Data keahlian dengan ID {$id} tidak ditemukan.");
                }

                $expertise->delete();
                return ['id' => (int) $id, 'message' => "Data keahlian dengan ID {$id} berhasil dihapus."];

            default:
                throw new \InvalidArgumentException("Tool '{$name}' tidak dikenal.");
        }
    }
}
