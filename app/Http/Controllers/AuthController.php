<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $response = Http::post(config('services.api.url') . '/register', [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'password_confirmation' => $data['password_confirmation']
        ]);

        if ($response->failed()) {
            return back()->withErrors(['email' => 'Registration failed'])->withInput();
        }

        session(['api_token' => $response->json('token')]);


        return redirect()->route('todos.index');

    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $response = Http::post(config('services.api.url') . '/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($response->failed()) {
            return back()->withErrors([
                'email' => 'Invalid credentials',
            ]);
        }

        session(['api_token' => $response->json('token')]);

        return redirect()->route('todos.index');
    }


    public function logout(Request $request)
    {
        $token = session('api_token');
        \Log::info('API token finded', [
            'token' => session('api_token'),
        ]);
        if ($token) {
            try {
                Http::withHeaders([
                    'Authorization' => 'Bearer ' . $token,
                ])->post(config('services.api.url') . '/logout');
            } catch (\Exception $e) {
                \Log::error('API logout failed: ' . $e->getMessage());
            }
        }

        $request->session()->forget('api_token');
        $request->session()->flush();

        return redirect('/')->with('success', 'Logged out successfully!');
    }
}
