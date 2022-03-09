<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

trait ImageTrait
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


    public function updatePreviewImage(Request $request, $post, $update)
    {

        if($request->hasFile('preview_image'))
        {
            if($update)
            {

                $destination = 'images/preview_images/'.$post->preview_image;
                if (File::exists($destination))
                {
                    File::delete($destination);
                }
            }

            $file = $request->file('preview_image');
            $ext = $file->getClientOriginalExtension();
            $name = $file->getClientOriginalName();
            $filename = pathinfo($name, PATHINFO_FILENAME).date('d-m-Y').'.'.$ext;
            $file->move('images/preview_images/', $filename);
            $post->preview_image = $filename;
        }
    }

    public function updateMainImage(Request $request, $post, $update)
    {

        if($request->hasFile('main_image'))
        {
            if($update)
            {
                $destination = 'images/main_images/'.$post->main_image;
                if (File::exists($destination))
                {
                    File::delete($destination);
                }
            }
            $file = $request->file('main_image');
            $ext = $file->getClientOriginalExtension();
            $name = $file->getClientOriginalName();
            $filename = pathinfo($name, PATHINFO_FILENAME).date('d-m-Y').'.'.$ext;
            $file->move('images/main_images/', $filename);
            $post->main_image = $filename;
        }
    }

}
