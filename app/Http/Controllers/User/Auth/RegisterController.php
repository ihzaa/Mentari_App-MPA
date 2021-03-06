<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function registerGet()
    {
        return view('FrontEnd.pages.register');
    }

    public function registerPost(RegisterRequest $request)
    {
        $request->validated();

        $user = User::create([
            'password' => Hash::make($request->password),
            'name' => $request->nama,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        Auth::guard('user')->loginUsingId($user->id);
        return redirect(route('user.home'));
    }
}
