<?php

namespace App\Http\Traits;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
            $this->extract('preview_image', 'preview_images', $request, $post, 'preview_image');
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
            $this->extract('main_image', 'main_images', $request, $post, 'main_image');
        }
    }
    public function uploadProfileImage(Request $request, $admin, $update) {
        if($request->hasFile('profile_image'))
        {
            if($update)
            {
                $destination = 'images/profile_images/'.$admin->profile_image;
                if (File::exists($destination))
                {
                    File::delete($destination);
                }
            }
            $this->extract('profile_image', 'profile_images', $request, $admin, 'profile_image');
        }
    }
    public function uploadImageNew(Request $request) {
        $request->validate([
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $image_name = $request->main_image->getClientOriginalName().time().'.'.$request->main_image->extension();
        $path = Storage::disk('s3')->put('main_images', $request->main_image);
        $pathUrl = Storage::disk('s3')->url($path);
        $image = new Image;
        $image->filename = $image_name;
        $image->url = $pathUrl;
        $image->save();

        $id = $image->id;
        return $id;
    }

    public function extract($image, $folder, $request, $table, $fileUploaded)
    {

        $file = $request->file($image);
        $ext = $file->getClientOriginalExtension();
        $name = $file->getClientOriginalName();
        $filename = pathinfo($name, PATHINFO_FILENAME).date('d-m-Y').'.'.$ext;
        $file->move('images/'. $folder .'/', $filename);
        $table->$fileUploaded = $filename;
    }

}
