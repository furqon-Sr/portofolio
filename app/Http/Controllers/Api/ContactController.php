<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactController extends BaseApiController
{
    /**
     * Get list of received contact messages.
     *
     * GET /api/contacts
     */
    public function index(Request $request): JsonResponse
    {
        $limit = min(max((int) $request->query('limit', 50), 1), 100);

        $messages = Contact::latest()->take($limit)->get();

        return $this->successResponse(
            $messages,
            'Daftar pesan kontak berhasil diambil.'
        );
    }
}
