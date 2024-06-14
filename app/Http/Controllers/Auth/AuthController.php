<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }
    public function login(LoginRequest $request)
    {
        //dd($request->all());
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', $email)->first();
        //$user = $request->user();
        //$hashed_password = Hash::check($password, $user->password);
        //$crediantials = ['email' => $user->email, 'password' => Hash::check($password, $user->password)];
        //if (Auth::attempt($crediantials)) {
        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user);
            return redirect()->route('tasks.index');
        } else {
            return redirect()
                ->route('login')
                ->withErrors('Incorrect email or password')
                ->onlyInput('email');
        }
    }
    public function register(RegisterRequest $request)
    {
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
        return redirect('login');
    }
    public function showRegister()
    {
        return view('auth.register');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()
            ->route('login');
    }
}
