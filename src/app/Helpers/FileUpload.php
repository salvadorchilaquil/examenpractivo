<?php

namespace App\Helpers;

class FileUpload
{
    public static function save($input_file, $public_path, $model)
    {
     // Get the temporary path using the serverId returned by the upload function in `FilepondController.php`
        $filepond = app(\Sopamo\LaravelFilepond\Filepond::class);
        $path = $filepond->getPathFromServerId($input_file);
        $extension = explode('.',$path);
        // Move the file from the temporary path to the final location
        $photoName = $model."_".time().'.'.$extension[1];
        $finalLocation = public_path($public_path.'/'.$photoName);
        if (!file_exists(public_path($public_path)))
        {
            mkdir(public_path($public_path));
        }
        \File::move($path, $finalLocation);
        return $photoName;
    }

}
