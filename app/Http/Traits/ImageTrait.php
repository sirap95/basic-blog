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

            //NEW LOGIC FOR S3 AWS
            $file = $request->file('upload');
            $randomFileName = uniqid(rand());
            $path = 'content_images/' . $randomFileName . '.' . $request->file('upload')->extension();
            Storage::disk('s3')->put($path, file_get_contents($file));
            $pathUrl = Storage::disk('s3')->url($path);

            $image = new Image;
            $image->filename = $path;
            $image->url = $pathUrl;
            $image->folder = 'content_images';

            $image->save();

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');

            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$pathUrl', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }

    //TODO: Delete row in image table if already exist and delete image on S3 Bucket
    public function uploadPreviewImageNew(Request $request, $post, $update)
    {
        $request->validate([
            'preview_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        //$image_name = $request->preview_image->getClientOriginalName() . time() . '.' . $request->preview_image->extension();
        if ($update) {

            $preview_image_url = Image::where('post_id', '=', $post->id)
                ->where('folder', '=', 'preview_images')
                ->value('url');

            Storage::disk('s3')->delete($preview_image_url);
            Image::where('post_id', '=', $post->id)
                ->where('folder', '=', 'preview_images')->delete();

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

    public function uploadProfileImageNew(Request $request, $id, $update)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($update) {
            $profile_image_url = Image::where('user_id', '=', $id)
                ->where('folder', '=', 'profile_images')
                ->value('url');

            Storage::disk('s3')->delete($profile_image_url);

            Image::where('user_id', '=', $id)
                ->where('folder', '=', 'profile_images')->delete();
        }

        $file = $request->profile_image;
        $randomFileName = uniqid(rand());
        $path = 'profile_images/' . $randomFileName . '.' . $request->profile_image->extension();
        Storage::disk('s3')->put($path, file_get_contents($file));
        $pathUrl = Storage::disk('s3')->url($path);
        $image = new Image;

        $image->filename = $path;
        $image->url = $pathUrl;
        $image->folder = 'profile_images';
        $image->user_id = $id;
        $image->save();

    }
  
}
