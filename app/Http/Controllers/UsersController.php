<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    //
    public function show(User $user){
        // render view show in users folder with a list of $user model
        return view('users.show', compact('user'));
    }

    public function edit(User $user){
        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user){
        
        $user->update($request->all());
        return redirect()->route('users.show', $user->id)->with('success', 'update success!');
    }
}
