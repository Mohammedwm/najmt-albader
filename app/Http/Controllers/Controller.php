<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Validation\ValidationException;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function upload_image(UploadedFile $file,$folder_name)
    {
        if ($file->isValid()) {
            return $file->store($folder_name, [
                'disk' => 'public',
            ]);
        } else {
            throw ValidationException::withMessages([
                'image' => 'File corrupted!',
            ]);
        }
    }
}
