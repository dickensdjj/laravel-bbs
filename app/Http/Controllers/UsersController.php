<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    //
    public function show(User $user){
        // render view show in users folder with a list of $user model
        return view('users.show', compact('user'));
    }


}
