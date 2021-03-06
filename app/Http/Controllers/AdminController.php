<?php

namespace App\Http\Controllers;

use App\Http\Traits\ImageTrait;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    use ImageTrait;

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $admin = User::findOrFail($id);
        $profile_image_url = Image::where('user_id', '=', $id)
            ->where('folder', '=', 'profile_images')
            ->value('url');
        return view('admin.detail', ['admin' => $admin, 'profile_image_url' => $profile_image_url]);
    }


    public function edit(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:50',
            'description' => 'required|min:15|max:600',
            'profile_image'
        ]);
        $user = User::find($id);

        $update = true;

        if ($request->profile_image == null)
            $update = false;

        $user->name = $request->input('name');
        $user->description = $request->input('description');
        $this->uploadProfileImageNew($request, $id, $update);
        $user->update();

        return redirect()->back()
            ->with('info', 'Admin edited, new description: ' . $request->input('description'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
