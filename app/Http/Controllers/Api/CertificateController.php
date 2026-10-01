<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Certificate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CertificateController extends BaseApiController
{
    /**
     * Get list of certificates.
     *
     * GET /api/certificates
     */
    public function index(Request $request): JsonResponse
    {
        $limit = min(max((int) $request->query('limit', 50), 1), 100);

        $certificates = Certificate::latest()->take($limit)->get();

        return $this->successResponse(
            $certificates,
            'Daftar sertifikat berhasil diambil.'
        );
    }

    /**
     * Store a new certificate.
     *
     * POST /api/certificates
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'issued_at' => 'required|string|max:255',
            'credential_id' => 'nullable|string|max:255',
            'credential_url' => 'nullable|url',
            'image_file' => 'nullable|mimes:jpg,jpeg,png,webp,pdf|max:10240',
            'image_url' => 'nullable|url',
            'image' => 'nullable|string',
        ]);

        $name = $validated['name'];
        $image = 'cert.png';

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $mime = strtolower($file->getMimeType());
            $ext = strtolower($file->getClientOriginalExtension());
            if ($ext === 'pdf' || str_contains($mime, 'pdf')) {
                $image = AdminController::uploadToR2($file, 'certificates', 'cert-' . Str::slug($name));
            } else {
                $rawBase64 = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($file->getRealPath()));
                $compressed = AdminController::compressBase64Image($rawBase64);
                $image = AdminController::uploadToR2($compressed, 'certificates', 'cert-' . Str::slug($name));
            }
        } elseif ($request->filled('image_url')) {
            $image = $request->input('image_url');
        } elseif ($request->filled('image')) {
            $rawImage = $request->input('image');
            if (str_starts_with($rawImage, 'data:')) {
                $compressed = AdminController::compressBase64Image($rawImage);
                $image = AdminController::uploadToR2($compressed, 'certificates', 'cert-' . Str::slug($name));
            } else {
                $image = $rawImage;
            }
        }

        $certificate = Certificate::create([
            'name' => $name,
            'issuer' => $validated['issuer'],
            'issued_at' => $validated['issued_at'],
            'credential_id' => $validated['credential_id'] ?? null,
            'credential_url' => $validated['credential_url'] ?? null,
            'image' => $image,
        ]);

        return $this->successResponse(
            $certificate,
            'Sertifikat baru berhasil ditambahkan.',
            201
        );
    }
}
