<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view("pages.login");
    }

    public function prosesLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('home');
        };

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function editProfile(Request $request)
    {

        return view("pages.edit-profile");
    }

    public function updateProfile(Request $request)
    {
        $validasi = [];

        if (auth()->user()->email !== $request->email) {
            $validasi['email'] = "email|unique:users,email";
        }

        $request->validate($validasi);

        $data = $request->only("name", "email");

        if ($request->password) {
            $data["password"] = Hash::make($request->password);
        }

        $user = User::where("id", auth()->user()->id)->update($data);

        return redirect()->back()
            ->with("success", "Berhasil update profile");
    }
}
