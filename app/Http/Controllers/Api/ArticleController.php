<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends BaseApiController
{
    /**
     * Get list of published articles.
     *
     * GET /api/articles
     */
    public function index(Request $request): JsonResponse
    {
        $limit = min(max((int) $request->query('limit', 50), 1), 100);

        $articles = Article::latest()->take($limit)->get();

        return $this->successResponse(
            $articles,
            'Daftar artikel blog berhasil diambil.'
        );
    }

    /**
     * Store and publish a new article.
     *
     * POST /api/articles
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
            'cover_image_url' => 'nullable|url',
            'cover_image_source' => 'nullable|string|max:255',
            'cover_image_source_url' => 'nullable|url',
            'cover_image' => 'nullable|string',
            'cover_image_file' => 'nullable|image|max:10240',
            'references' => 'nullable|array',
            'references.*.title' => 'required_with:references|string',
            'references.*.url' => 'required_with:references|url',
        ]);

        $title = $validated['title'];
        $coverImage = null;

        if ($request->hasFile('cover_image_file')) {
            $file = $request->file('cover_image_file');
            $rawBase64 = 'data:' . $file->getMimeType() . ';base64,' . base64_encode(file_get_contents($file->getRealPath()));
            $compressed = AdminController::compressBase64Image($rawBase64);
            $coverImage = AdminController::uploadToR2($compressed, 'articles', Str::slug($title));
        } elseif ($request->filled('cover_image_url')) {
            $coverImage = $request->input('cover_image_url');
        } elseif ($request->filled('cover_image')) {
            $rawCover = $request->input('cover_image');
            if (str_starts_with($rawCover, 'data:image')) {
                $compressed = AdminController::compressBase64Image($rawCover);
                $coverImage = AdminController::uploadToR2($compressed, 'articles', Str::slug($title));
            } else {
                $coverImage = $rawCover;
            }
        }

        $references = $request->input('references');
        if (is_array($references)) {
            $references = array_values($references);
        } else {
            $references = [];
        }

        $article = Article::create([
            'title' => $title,
            'slug' => Str::slug($title) . '-' . time(),
            'excerpt' => $validated['excerpt'] ?? null,
            'content' => $validated['content'],
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'meta_keywords' => $validated['meta_keywords'] ?? null,
            'cover_image' => $coverImage,
            'cover_image_source' => $validated['cover_image_source'] ?? null,
            'cover_image_source_url' => $validated['cover_image_source_url'] ?? null,
            'references' => $references,
        ]);

        return $this->successResponse(
            $article,
            'Artikel blog berhasil diterbitkan.',
            201
        );
    }

    /**
     * Update an existing article.
     *
     * PUT/PATCH /api/articles/{id}
     */
    public function update(Request $request, $id): JsonResponse
    {
        $article = Article::find($id);

        if (!$article) {
            return $this->errorResponse('Artikel tidak ditemukan.', null, 404);
        }

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
            'cover_image_url' => 'nullable|url',
            'cover_image_source' => 'nullable|string|max:255',
            'cover_image_source_url' => 'nullable|url',
            'cover_image' => 'nullable|string',
            'cover_image_file' => 'nullable|image|max:10240',
            'references' => 'nullable|array',
            'references.*.title' => 'required_with:references|string',
            'references.*.url' => 'required_with:references|url',
        ]);

        $updateData = [];

        if ($request->has('title')) {
            $updateData['title'] = $validated['title'];
            $updateData['slug'] = Str::slug($validated['title']) . '-' . $article->id;
        }

        if ($request->has('excerpt')) {
            $updateData['excerpt'] = $validated['excerpt'];
        }

        if ($request->has('content')) {
            $updateData['content'] = $validated['content'];
        }

        if ($request->has('meta_title')) {
            $updateData['meta_title'] = $validated['meta_title'];
        }

        if ($request->has('meta_description')) {
            $updateData['meta_description'] = $validated['meta_description'];
        }

        if ($request->has('meta_keywords')) {
            $updateData['meta_keywords'] = $validated['meta_keywords'];
        }

        if ($request->has('cover_image_source')) {
            $updateData['cover_image_source'] = $validated['cover_image_source'];
        }

        if ($request->has('cover_image_source_url')) {
            $updateData['cover_image_source_url'] = $validated['cover_image_source_url'];
        }

        if ($request->hasFile('cover_image_file')) {
            $file = $request->file('cover_image_file');
            $rawBase64 = 'data:' . $file->getMimeType() . ';base64,' . base64_encode(file_get_contents($file->getRealPath()));
            $compressed = AdminController::compressBase64Image($rawBase64);
            $title = $updateData['title'] ?? $article->title;
            $updateData['cover_image'] = AdminController::uploadToR2($compressed, 'articles', Str::slug($title));
        } elseif ($request->filled('cover_image_url')) {
            $updateData['cover_image'] = $request->input('cover_image_url');
        } elseif ($request->filled('cover_image')) {
            $rawCover = $request->input('cover_image');
            if (str_starts_with($rawCover, 'data:image')) {
                $compressed = AdminController::compressBase64Image($rawCover);
                $title = $updateData['title'] ?? $article->title;
                $updateData['cover_image'] = AdminController::uploadToR2($compressed, 'articles', Str::slug($title));
            } else {
                $updateData['cover_image'] = $rawCover;
            }
        }

        if ($request->has('references')) {
            $refs = $request->input('references');
            $updateData['references'] = is_array($refs) ? array_values($refs) : [];
        }

        $article->update($updateData);

        return $this->successResponse(
            $article->fresh(),
            'Artikel blog berhasil diperbarui.'
        );
    }
}
