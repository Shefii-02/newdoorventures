<?php

namespace App\Class;

class RvMediaService
{
    public function upload($file, $path)
    {
        $destination = public_path($path);
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move($destination, $filename);

        return "/{$path}/{$filename}";
    }

    public function delete($filePath)
    {
        if (file_exists(public_path($filePath))) {
            unlink(public_path($filePath));
        }
    }
}
