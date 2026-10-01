<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends BaseApiController
{
    /**
     * Get list of portfolio projects.
     *
     * GET /api/projects
     */
    public function index(Request $request): JsonResponse
    {
        $limit = min(max((int) $request->query('limit', 50), 1), 100);

        $query = Project::query();

        if ($request->filled('category')) {
            $query->where('category', $request->query('category'));
        }

        $projects = $query->latest()->take($limit)->get();

        return $this->successResponse(
            $projects,
            'Daftar portofolio berhasil diambil.'
        );
    }

    /**
     * Store a new portfolio project.
     *
     * POST /api/projects
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'required|string',
            'live_link' => 'nullable|url',
            'github_link' => 'nullable|url',
            'cover_image_file' => 'nullable|image|max:10240',
            'cover_image_url' => 'nullable|url',
            'cover_image' => 'nullable|string',
            'design_pdf_file' => 'nullable|file|mimes:pdf|max:30720',
            'design_pdf_url' => 'nullable|string',
            'design_file' => 'nullable|string',
        ]);

        $title = $validated['title'];

        // Handle Design File / PDF document
        $designFile = null;
        if ($request->hasFile('design_pdf_file')) {
            $pdf = $request->file('design_pdf_file');
            $designFile = AdminController::uploadToR2($pdf, 'designs', 'design-' . Str::slug($title));
        } elseif ($request->filled('design_pdf_url')) {
            $designFile = $request->input('design_pdf_url');
        } elseif ($request->filled('design_file')) {
            $designFile = $request->input('design_file');
        }

        // Handle Cover Image
        $coverImage = 'image.png'; // default fallback
        if ($request->hasFile('cover_image_file')) {
            $file = $request->file('cover_image_file');
            $rawBase64 = 'data:' . $file->getMimeType() . ';base64,' . base64_encode(file_get_contents($file->getRealPath()));
            $compressed = AdminController::compressBase64Image($rawBase64);
            $coverImage = AdminController::uploadToR2($compressed, 'projects', Str::slug($title));
        } elseif ($request->filled('cover_image_url')) {
            $coverImage = $request->input('cover_image_url');
        } elseif ($request->filled('cover_image')) {
            $rawCover = $request->input('cover_image');
            if (str_starts_with($rawCover, 'data:image')) {
                $compressed = AdminController::compressBase64Image($rawCover);
                $coverImage = AdminController::uploadToR2($compressed, 'projects', Str::slug($title));
            } else {
                $coverImage = $rawCover;
            }
        } elseif ($validated['category'] === 'Design' && !empty($designFile)) {
            $coverImage = 'pdf-default';
        }

        $project = Project::create([
            'title' => $title,
            'slug' => Str::slug($title) . '-' . time() . '-' . Str::random(4),
            'category' => $validated['category'],
            'description' => $validated['description'],
            'live_link' => $validated['live_link'] ?? null,
            'github_link' => $validated['github_link'] ?? null,
            'cover_image' => $coverImage,
            'design_file' => $designFile,
        ]);

        return $this->successResponse(
            $project,
            'Portofolio baru berhasil ditambahkan.',
            201
        );
    }

    /**
     * Update an existing portfolio project.
     *
     * PUT/PATCH /api/projects/{id}
     */
    public function update(Request $request, $id): JsonResponse
    {
        $project = Project::find($id);

        if (!$project) {
            return $this->errorResponse('Proyek portofolio tidak ditemukan.', null, 404);
        }

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'live_link' => 'nullable|url',
            'github_link' => 'nullable|url',
            'cover_image_file' => 'nullable|image|max:10240',
            'cover_image_url' => 'nullable|url',
            'cover_image' => 'nullable|string',
            'design_pdf_file' => 'nullable|file|mimes:pdf|max:30720',
            'design_pdf_url' => 'nullable|string',
            'design_file' => 'nullable|string',
        ]);

        $updateData = [];

        if ($request->has('title')) {
            $updateData['title'] = $validated['title'];
            $updateData['slug'] = Str::slug($validated['title']) . '-' . $project->id;
        }

        if ($request->has('category')) {
            $updateData['category'] = $validated['category'];
        }

        if ($request->has('description')) {
            $updateData['description'] = $validated['description'];
        }

        if ($request->has('live_link')) {
            $updateData['live_link'] = $validated['live_link'];
        }

        if ($request->has('github_link')) {
            $updateData['github_link'] = $validated['github_link'];
        }

        // Handle Design File / PDF document
        if ($request->hasFile('design_pdf_file')) {
            $pdf = $request->file('design_pdf_file');
            $title = $updateData['title'] ?? $project->title;
            $updateData['design_file'] = AdminController::uploadToR2($pdf, 'designs', 'design-' . Str::slug($title));
        } elseif ($request->filled('design_pdf_url')) {
            $updateData['design_file'] = $request->input('design_pdf_url');
        } elseif ($request->filled('design_file')) {
            $updateData['design_file'] = $request->input('design_file');
        }

        // Handle Cover Image
        if ($request->hasFile('cover_image_file')) {
            $file = $request->file('cover_image_file');
            $rawBase64 = 'data:' . $file->getMimeType() . ';base64,' . base64_encode(file_get_contents($file->getRealPath()));
            $compressed = AdminController::compressBase64Image($rawBase64);
            $title = $updateData['title'] ?? $project->title;
            $updateData['cover_image'] = AdminController::uploadToR2($compressed, 'projects', Str::slug($title));
        } elseif ($request->filled('cover_image_url')) {
            $updateData['cover_image'] = $request->input('cover_image_url');
        } elseif ($request->filled('cover_image')) {
            $rawCover = $request->input('cover_image');
            if (str_starts_with($rawCover, 'data:image')) {
                $compressed = AdminController::compressBase64Image($rawCover);
                $title = $updateData['title'] ?? $project->title;
                $updateData['cover_image'] = AdminController::uploadToR2($compressed, 'projects', Str::slug($title));
            } else {
                $updateData['cover_image'] = $rawCover;
            }
        }

        $project->update($updateData);

        return $this->successResponse(
            $project->fresh(),
            'Portofolio berhasil diperbarui.'
        );
    }
}
