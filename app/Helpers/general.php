<?php

use \App\Models\User;
use Illuminate\Support\Facades\Storage;

function getFolder(){
    return app()->getLocale() === 'ar' ? 'css-rtl' : 'css';
}

function uploadImage($folder, $image){
    // Get the disk instance
    $disk = Storage::disk('public');

    // Ensure the folder exists
    if (!$disk->exists($folder)) {
        $disk->makeDirectory($folder);
    }

    // Store the image
    $path = $image->store($folder, 'public');
    $filename = basename($path);

    return $filename;
}

function remove_previous($folder, $model)
{
    Storage::disk('public')->delete($folder . '/' . $model->image);
} // end of remove_previous function

function remove_image($folder, $image)
{
    Storage::disk('public')->delete($folder . '/' . $image);
} // end of remove_image function

function image_path($val)
{
    return asset('storage/images/' . $val);
}
