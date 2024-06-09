<?php

namespace App\Http\Controllers;

use App\Services\CloudinaryUploadService;
use Illuminate\Http\Request;

class CloudinaryUploadController extends Controller
{
    //
    /**
     * @throws \Exception
     */
    public function uploadImage(Request $request): \Illuminate\Http\JsonResponse
    {
        $service = new CloudinaryUploadService();

        $uploadedUrl = $service->uploadImage($request);

        if (empty($uploadedUrl)) {
            return response()->json([
                'status' => false,
                'message' => 'Failed',
            ]);
        }

        return response()->json([
            'status' => true,
            'uploaded_url' => $uploadedUrl,
        ]);
    }
}
