<?php

namespace App\Http\Controllers;

class UsersController extends Controller
{
    public function profile()
    {
        $userLoginNow = auth()->user();
        return view('profile.index', [
            'userLoginNow' => $userLoginNow
        ]);
    }
}
