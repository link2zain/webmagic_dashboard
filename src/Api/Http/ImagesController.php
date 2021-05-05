<?php


namespace Webmagic\Dashboard\Api\Http;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagesController
{
    /**
     * Upload image
     *
     * @param string  $fieldName
     * @param Request $request
     *
     * @return mixed
     */
    public function upload(string $fieldName, Request $request)
    {
        // For situation when block works with multiple files
        $fieldName = str_replace(['[', ']', '%5B', '%5D'],'',$fieldName);

        $request->validate([
           "$fieldName" => "required"
        ]);

        $file = $request->file($fieldName);
        // For situation when block works with multiple files
        if(is_array($file)){
            $file = array_first($file);
        }

        $photoPath = config('webmagic.dashboard.dashboard.images_directory');
        $path = $file->store($photoPath, 'public');

        return Storage::url($path);
    }

    /**
     * Delete image
     *
     * @param Request $request
     */
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|string'
        ]);

        $id = str_replace('/storage/', '', $request->id);

        Storage::disk('public')->delete($id);
    }
}
