<?php

namespace App\Services;

use App\Models\CloudinaryMedia;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CloudinaryUploadService
{
    /**
     * @throws \Exception
     */
    public function uploadImage(Request $request)
    {
        $file = $request->file('file');

        $option = [
            "folder" => "my_images",
//            "overwrite" => TRUE,
//            "resource_type" => "image",
        ];

//        $option = [
//            "folder" => "my_images",
////            "overwrite" => TRUE,
////            "resource_type" => "image",
//            'transformation' => [
//                [
//                    'width' => 100,    // Desired width
//                    'height' => 100,   // Desired height
//                    'fetch' => 'auto',
//                    'crop' => 'scale',  // Crop mode (you can change this to 'fit' or other modes)
//                ],
//            ],
//        ];

        $uploadedFileUrl = Cloudinary::upload($file->getRealPath(), $option)->getSecurePath();
        if (!empty($uploadedFileUrl)) {

            $optimized = $this->createThumbnail($uploadedFileUrl);

            $request->request->add(['optimized_url' => $optimized]);

            $cloudinaryMedia = CloudinaryMedia::create($request->input());
            $cloudinaryMedia->attachMedia($file);
        }


        return $uploadedFileUrl;
    }

    private function createThumbnail($uploadedFileUrl): string
    {
        // Example : https://res.cloudinary.com/lamhenvtest/image/upload/v1717859345/my_images/mmkvuejfpqrxe8hnbcdn.png
        $slice = Str::after($uploadedFileUrl, 'upload/');

        $w = 100;
        $h = 100;
        $c = 'scale';
        return "https://res.cloudinary.com/lamhenvtest/image/upload/w_{$w},h_{$h},c_{$c}/{$slice}";
    }
}
