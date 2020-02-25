<?php

namespace App\Http\Controllers;

use App\Post;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id')->all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:100',
            'email'=>'required|email',
            'password'=>'required|between:6,20',
            'role_id'=>'numeric|max:100',
            'is_active'=>'nullable|numeric|max:2',
            'file'=>'nullable|file|image'
        ]);
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        if($photo = $request->file('file')){
//            $photo_name = $user['name'] . '.' . $photo->getClientOriginalExtension();
//            $photo->move('images/users', $photo_name);
            //Following method upload the file into 'storage/app/public/avatars/' folder.
            //'Public' is used to be visible using by web. In order to be visible, we must
            // use artisan command: "php artisan storage:link" to link the route to the file
            // in storage/api/public folder!
            // We can also use method "Storage::putFile('folder', $request->file('file'))
            // Also to give custom name to file, we can use methods storeAs or Storage::putFileAs
            // but on file name we need to add the extension: with $photo->getClientOriginalExtension();
            $path = Storage::disk('public')->putFileAs('avatars', $photo, $user->name . "." . $photo->getClientOriginalExtension());
            //The following line has same function like the above one:
//            $path = $photo->storeAs('avatars', $user->name . "." . $photo->getClientOriginalExtension(), 'public');

            $user->medias()->create(['file'=>$path, 'is_approved'=>'1']);
//            $user->medias()->create(['file'=>'users/' . $photo_name, 'is_approved'=>'1']); //user after been created above, have id
        }else{
//            $user->medias()->create(['file'=>'users/default.png', 'is_approved'=>'1']);
            $user->medias()->create(['file'=>'avatars/default.png', 'is_approved'=>'1']);
        }
        Session::flash('msg', "The user profile has been created!");
        return redirect('admin/users');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $postsCount = Post::count();
        $postsCount = round($user->posts->count() / $postsCount * 100);


        return view('admin.users.show', compact('user', 'postsCount'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = User::findOrFail($id);
        $postsCount = Post::count();
        $postsCount = round($user->posts->count() / $postsCount * 100);
        $roles = Role::pluck('name', 'id')->all();
        return view('admin.users.edit', compact('user', 'roles', 'postsCount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request,[
            'name'=>'required|max:100',
            'email'=>'required|email',
            'password'=>'nullable|between:6,20',
            'role_id'=>'required|numeric|max:100',
            'is_active'=>'nullable|numeric|max:2',
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
//            $photo_name = $input['name'] . '.' . $photo->getClientOriginalExtension();
//            if(in_array($photo->getClientOriginalExtension(),['jpg','png','bmp'])){
//                if($photo->getSize() < 1100000) {
                    $path = $photo->storeAs('avatars', $user->name . "." . $photo->getClientOriginalExtension(), 'public');
//                    $photo->move('images/users', $photo_name);
                    $user->medias()->create(['file' => $path, 'is_approved'=>'1']);
                    //TODO update instead of create!
//                }else{
//                    return "File size over 1Mb";
//                }
//            }else{
//                return "File is not Image";
//            }
        }
        //TODO - if only photo is updated, timestamp 'updated_at' is not updated because user is updated before file!
        Session::flash('msg', "The user profile has been updated!");
        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        foreach ($user->medias as $media) {
            //In order to keep the default.png image in users folder...
            if($media->file != "avatars/default.png") {
                if (file_exists(str_replace('\\', '/', public_path()) . "/storage/" . $media->file)) {
                    //Use str_replace because public_path returns slashes - not for Windows
//                    unlink(str_replace('\\', '/', public_path()) . "/storage/" . $media->file);
                    Storage::disk('public')->delete($media->file);
                }
            }
        }
        //This user records in media table are deleted as cascade by set foreign key
        $user->delete();
        Session::flash('msg', "The user profile has been deleted!");
        return redirect('admin/users');
    }
}
