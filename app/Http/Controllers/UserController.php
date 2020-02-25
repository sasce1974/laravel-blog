<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //
    public function show($id){
        $user = User::findOrFail($id);
        $postsCount = Post::count();
        $postsCount = round($user->posts->count() / $postsCount * 100);
        return view('all_users.show_user', compact('user', 'postsCount'));
    }


    public function edit(){
        $user = Auth::user();
        $postsCount = Post::count();
        $postsCount = round($user->posts->count() / $postsCount * 100);
        return view('all_users.edit_user', compact('user', 'postsCount'));
    }

    public function update(Request $request){
        $user = Auth::user();

        $this->validate($request,[
            'name'=>'required|max:100',
            'email'=>'required|email',
            'password'=>'nullable|between:6,20',
            'file'=>'nullable|file|image|max:1024'
        ]);

        if(trim($request->password) == ""){
            $input = $request->except('password');
        }else{
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
        }

        $user->update($input);

        if($photo = $request->file('file')){
            $path = $photo->storeAs('avatars', $user->name . "." . $photo->getClientOriginalExtension(), 'public');
            $user->medias()->updateOrCreate(['file' => $path, 'is_approved'=>'1']);
            //TODO make update instead of create media!
        }

        Session::flash('msg', "The user profile has been updated!");
        return redirect("show/user/$user->id");

    }

    public function destroy(){
        $user = Auth::user();

        foreach ($user->medias as $media) { //TODO: only 1 media per user
            //In order to keep the default.png image in users folder...
            if($media->file != "avatars/default.png") {
                if (file_exists(str_replace('\\', '/', public_path()) . "/storage/" . $media->file)) {
                    //Use str_replace because public_path returns slashes - not for Windows
                    Storage::disk('public')->delete($media->file);
                }
            }
        }
        //This user records in media table are deleted as cascade by set foreign key
        $user->delete();
        Session::flash('msg', "The user profile has been deleted!");
        return redirect('/');
    }
}
