<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageService
{
    public function __construct()
    {

    }

    function uploadFile(UploadedFile $file): string|bool
    {
        if (!$file->isValid()) {
            return false;
        }
        $extension = $file->getClientOriginalExtension();
        $currDate = new \DateTimeImmutable();
        $filename = "uploads_" . $currDate->format('d-m-Y__H-i-s_u__') . '.' . $extension;
        $file->move("uploads/", $filename);
        return $filename;
    }
}