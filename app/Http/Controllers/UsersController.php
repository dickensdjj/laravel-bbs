<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    //
    public function show(User $user){
        
        // do polcy in controller
        $this -> authorize('show',$user);

        return view('users.show', compact('user'));
    }

    public function edit(User $user){
        $this -> authorize('edit', $user);
        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, ImageUploadHandler $uploader, User $user){

        $this -> authorize('update', $user);
        // validate request profile image
        // dd($request->avatar);

        $data = $request -> all();

        //print_r($data);

        if ($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $user->id, 362);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }

        $user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', 'update success!');
    }


}
