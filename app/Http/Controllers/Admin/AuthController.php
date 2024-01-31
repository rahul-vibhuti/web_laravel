<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.auth.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required']
        ], [
            'email.exists' => 'Email not exists',
            'email.required' => 'Email is required'
        ]);


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('dashboard');
        }
        return redirect()->back()->with('error', 'Email or password not match');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = User::find(Auth::id());
        return view('admin.pages.auth.profile', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = User::find(Auth::id());
        if ($request->filled('first_name')) {
            $user->first_name = $request->first_name;
        }
        if ($request->filled('last_name')) {
            $user->last_name = $request->last_name;
        }
        if ($request->filled('bio')) {
            $user->bio = $request->bio;
        }
        if ($request->file('image')) {
            $file =  $this->Upload($request->file('image'), 'profiles');
            $user->image = $file;
        }
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
