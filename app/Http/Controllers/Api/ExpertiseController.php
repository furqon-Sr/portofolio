<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Expertise;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExpertiseController extends BaseApiController
{
    /**
     * Get list of all expertises.
     *
     * GET /api/expertise
     */
    public function index(Request $request): JsonResponse
    {
        $limit = $request->has('limit') 
            ? min(max((int) $request->query('limit', 50), 1), 100) 
            : null;

        $query = Expertise::orderBy('id', 'asc');

        if ($limit) {
            $expertises = $query->take($limit)->get();
        } else {
            $expertises = $query->get();
        }

        return $this->successResponse(
            $expertises,
            'Daftar keahlian berhasil diambil.'
        );
    }

    /**
     * Store a new expertise.
     *
     * POST /api/expertise
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|url',
            'logo' => 'nullable|string',
            'logo_url' => 'nullable|url',
            'logo_file' => 'nullable|image|max:2048',
            'bg_class' => 'nullable|string|max:255',
            'hover_class' => 'nullable|string|max:255',
        ]);

        $name = $validated['name'];
        $logo = 'code.svg';

        if ($request->hasFile('logo_file')) {
            $file = $request->file('logo_file');
            $mime = strtolower($file->getMimeType());
            $ext = strtolower($file->getClientOriginalExtension());
            if ($ext === 'svg' || str_contains($mime, 'svg')) {
                $logo = AdminController::uploadToR2($file, 'expertise', Str::slug($name));
            } else {
                $rawBase64 = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($file->getRealPath()));
                $compressed = AdminController::compressBase64Image($rawBase64);
                $logo = AdminController::uploadToR2($compressed, 'expertise', Str::slug($name));
            }
        } elseif ($request->filled('logo_url')) {
            $logo = $request->input('logo_url');
        } elseif ($request->filled('logo')) {
            $logo = $request->input('logo');
        }

        $expertise = Expertise::create([
            'name' => $name,
            'url' => $validated['url'] ?? null,
            'logo' => $logo,
            'bg_class' => $validated['bg_class'] ?? 'bg-white',
            'hover_class' => $validated['hover_class'] ?? 'hover:border-blue-500',
        ]);

        return $this->successResponse(
            $expertise,
            'Data keahlian berhasil ditambahkan.',
            201
        );
    }

    /**
     * Update an existing expertise.
     *
     * PUT /api/expertise/{id}
     */
    public function update(Request $request, int|string $id): JsonResponse
    {
        $expertise = Expertise::find($id);

        if (!$expertise) {
            return $this->errorResponse(
                "Data keahlian dengan ID {$id} tidak ditemukan.",
                null,
                404
            );
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'url' => 'nullable|url',
            'logo' => 'nullable|string',
            'logo_url' => 'nullable|url',
            'logo_file' => 'nullable|image|max:2048',
            'bg_class' => 'nullable|string|max:255',
            'hover_class' => 'nullable|string|max:255',
        ]);

        $logo = $expertise->logo;
        if ($request->hasFile('logo_file')) {
            $file = $request->file('logo_file');
            $mime = strtolower($file->getMimeType());
            $ext = strtolower($file->getClientOriginalExtension());
            $slugName = Str::slug($validated['name'] ?? $expertise->name);
            if ($ext === 'svg' || str_contains($mime, 'svg')) {
                $logo = AdminController::uploadToR2($file, 'expertise', $slugName);
            } else {
                $rawBase64 = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($file->getRealPath()));
                $compressed = AdminController::compressBase64Image($rawBase64);
                $logo = AdminController::uploadToR2($compressed, 'expertise', $slugName);
            }
        } elseif ($request->filled('logo_url')) {
            $logo = $request->input('logo_url');
        } elseif ($request->filled('logo')) {
            $logo = $request->input('logo');
        }

        $updateData = [
            'logo' => $logo,
        ];

        if (array_key_exists('name', $validated)) {
            $updateData['name'] = $validated['name'];
        }
        if (array_key_exists('url', $validated)) {
            $updateData['url'] = $validated['url'];
        }
        if (array_key_exists('bg_class', $validated)) {
            $updateData['bg_class'] = $validated['bg_class'];
        }
        if (array_key_exists('hover_class', $validated)) {
            $updateData['hover_class'] = $validated['hover_class'];
        }

        $expertise->update($updateData);

        return $this->successResponse(
            $expertise->fresh(),
            'Data keahlian berhasil diperbarui.'
        );
    }

    /**
     * Delete an existing expertise.
     *
     * DELETE /api/expertise/{id}
     */
    public function destroy(int|string $id): JsonResponse
    {
        $expertise = Expertise::find($id);

        if (!$expertise) {
            return $this->errorResponse(
                "Data keahlian dengan ID {$id} tidak ditemukan.",
                null,
                404
            );
        }

        $expertise->delete();

        return $this->successResponse(
            ['id' => (int) $id],
            "Data keahlian dengan ID {$id} berhasil dihapus."
        );
    }
}
