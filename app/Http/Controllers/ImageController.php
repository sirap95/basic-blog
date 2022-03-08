<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

trait ImageController
{

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('images'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/' . $fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }

    public function uploadPreviewImage(Request $request)
    {

        if ($request->hasFile('preview_image')) {

            $image = $request->file('preview_image');
            return $this->extracted($image, "preview_images", 800,800);
        }
    }

    public function uploadMainImage(Request $request)
    {

        if ($request->hasFile('main_image')) {

            $image = $request->file('main_image');
            return $this->extracted($image, "main_images", 1280, 720);
        }
    }

    /**
     * @param array|\Illuminate\Http\UploadedFile|null $image
     * @return string
     */
    public function extracted(array|\Illuminate\Http\UploadedFile|null $image, $folder, $width, $height): string
    {
        $originName = $image->getClientOriginalName();
        $filename = pathinfo($originName, PATHINFO_FILENAME);

        $extension = $image->getClientOriginalExtension();
        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize($width, $height);
        $filename = $filename . '_' . time() . '.' . $extension;
        $path = ('images/'. $folder.'/' . $filename);
        $image_resize->save(public_path($path));

        return $path;
    }
}
