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

    //TODO: Delete row in post_image if already exist and delete image on S3 Bucket
    public function uploadPreviewImageNew(Request $request, $post, $update)
    {
        $request->validate([
            'preview_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        //$image_name = $request->preview_image->getClientOriginalName() . time() . '.' . $request->preview_image->extension();
        if ($update) {
            $image_ids = $post->getImageIdsAttribute();
            if (empty($image_ids)) {
                for ($i = 1; $i <= count($image_ids); $i++) {
                    $preview_image_url = Image::where('id', '=', $image_ids[$i - 1])
                        ->where('filename', 'like', 'preview%')
                        ->value('url');
                }
                Storage::disk('s3')->delete($preview_image_url);
            }
        }
        $file = $request->preview_image;
        $randomFileName = uniqid(rand());
        $path = 'preview_images/' . $randomFileName . '.' . $request->preview_image->extension();
        Storage::disk('s3')->put($path, file_get_contents($file));
        $pathUrl = Storage::disk('s3')->url($path);
        $image = new Image;
        $image->filename = $path;
        $image->url = $pathUrl;
        $image->folder = 'preview_images';
        $image->save();

        $id = $image->id;
        return $id;
    }
    /*
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
    } */
    //TODO: Delete row in post_image if already exist and delete image on S3 Bucket
    public function uploadMainImageNew(Request $request, $post, $update)
    {
        $request->validate([
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        //$image_name = $request->main_image->getClientOriginalName() . time() . '.' . $request->main_image->extension();
        if ($update) {
            $image_ids = $post->getImageIdsAttribute();
            if (empty($image_ids)) {
                for ($i = 1; $i <= count($image_ids); $i++) {
                    $main_image_url = Image::where('id', '=', $image_ids[$i - 1])
                        ->where('filename', 'like', 'main%')
                        ->value('url');
                }
                Storage::disk('s3')->delete($main_image_url);
            }
        }
        $file = $request->main_image;
        $randomFileName = uniqid(rand());
        $path = 'main_images/' . $randomFileName . '.' . $request->main_image->extension();
        Storage::disk('s3')->put($path, file_get_contents($file));
        $pathUrl = Storage::disk('s3')->url($path);
        $image = new Image;
        $image->filename = $path;
        $image->url = $pathUrl;
        $image->folder = 'main_images';
        $image->save();

        $id = $image->id;
        return $id;
    }
    /*
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
    */
    //TODO: create  relationship one to one between user and profile_image
    public function uploadProfileImageNew(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $image_name = $request->main_image->getClientOriginalName() . time() . '.' . $request->profile_image->extension();
        $path = Storage::disk('s3')->put('profile_images', $request->main_profile_imageimage);
        $pathUrl = Storage::disk('s3')->url($path);
        $image = new Image;
        $image->filename = $image_name;
        $image->url = $pathUrl;
        $image->save();

        $id = $image->id;
        return $id;
    }

    public function uploadProfileImage(Request $request, $admin, $update)
    {
        if ($request->hasFile('profile_image')) {
            if ($update) {
                $destination = 'images/profile_images/' . $admin->profile_image;
                if (File::exists($destination)) {
                    File::delete($destination);
                }
            }
            $this->extract('profile_image', 'profile_images', $request, $admin, 'profile_image');
        }
    }

    //TODO: Adapt the extract method to new update method on S3 Bucket
    public function extract($image, $folder, $request, $table, $fileUploaded)
    {

        $file = $request->file($image);
        $ext = $file->getClientOriginalExtension();
        $name = $file->getClientOriginalName();
        $filename = pathinfo($name, PATHINFO_FILENAME) . date('d-m-Y') . '.' . $ext;
        $file->move('images/' . $folder . '/', $filename);
        $table->$fileUploaded = $filename;
    }

}
